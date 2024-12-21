<?php 
include '../db_config.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmar_password = $_POST['confirmar_password']; 
    
    if ($password !== $confirmar_password) {
        echo "<script>
            alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');
            window.history.back();
        </script>";
        exit();
    } else {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                alert('El correo electrónico ya está registrado.');
                window.history.back();
            </script>";
            exit();
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nombre, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>
                    alert('Usuario registrado con éxito.');
                    window.location.href = '../../Avance2/index.html';
                </script>";
                exit();
            } else {
                echo "<script>
                    alert('Hubo un error al registrar al usuario. Intenta nuevamente.');
                    window.history.back();
                </script>";
                exit();
            }
        }
        $stmt->close();
    }
}
?>
