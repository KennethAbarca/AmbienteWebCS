<?php
include '../db_config.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    if ($nueva_contrasena !== $confirmar_contrasena) {
        echo "<script>
            alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');
            window.history.back();
        </script>";
        exit();
    }


    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hashed_password = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $hashed_password, $email);

        if ($stmt->execute()) {
            echo "<script>
                alert('Contraseña actualizada exitosamente.');
                window.location.href = '../../Avance2/login.html';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Hubo un error al actualizar la contraseña. Inténtalo nuevamente.');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('El correo proporcionado no está registrado.');
            window.history.back();
        </script>";
    }

    $stmt->close();
}
$conn->close();
?>
