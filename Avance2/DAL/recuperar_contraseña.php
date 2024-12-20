<?php
include '../db_config.php';  // Asegúrate de que la ruta a db_config.php sea correcta.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Generar un token único para la recuperación
        $token = bin2hex(random_bytes(50));  // Genera un token único y seguro
        $expires = date("U") + 1800;  // El token caduca después de 30 minutos
        
        // Insertar el token en la base de datos (para validarlo más tarde)
        $sql = "INSERT INTO recuperacion_contrasena (email, token, expires) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $email, $token, $expires);
        
        if ($stmt->execute()) {
            // Enviar el correo electrónico con el enlace de recuperación
            $to = $email;
            $subject = "Recuperación de Contraseña";
            $message = "Recibe este correo para restablecer tu contraseña: \n\n";
            $message .= "http://localhost/ProyectoAmbienteWebServidor/AmbienteWebCS/Avance2/recuperar_contrasena_form.php?token=$token\n\n";
            $message .= "Este enlace expirará en 30 minutos.";

            // Configurar el encabezado para el correo
            $headers = "From: no-reply@tudominio.com";

            // Enviar el correo
            if (mail($to, $subject, $message, $headers)) {
                echo "Se ha enviado un enlace para restablecer tu contraseña a tu correo electrónico.";
            } else {
                echo "Hubo un error al enviar el correo. Inténtalo de nuevo.";
            }
        } else {
            echo "Hubo un error al generar el enlace de recuperación.";
        }
    } else {
        echo "No se encontró ninguna cuenta asociada con este correo electrónico.";
    }
}
$conn->close();
?>
