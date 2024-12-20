<?php
include '../db_config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];  
            $_SESSION['user_email'] = $user['email']; 

            header("Location: /ProyectoAmbienteWebServidor/AmbienteWebCS/Avance2/index.html");
            exit();
        } else {
            $error_message = "Correo electrónico o contraseña incorrectos.";
            header("Location: /ProyectoAmbienteWebServidor/AmbienteWebCS/Avance2/login.html");
            exit();
        }
    } else {
        $error_message = "Correo electrónico o contraseña incorrectos.";
        header("Location: /ProyectoAmbienteWebServidor/AmbienteWebCS/Avance2/login.html");
            exit();
    }
}

$conn->close(); 
?>

