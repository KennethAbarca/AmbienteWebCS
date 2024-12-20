<?php
include '../db_config.php';  // Asegúrate de que la ruta a db_config.php sea correcta.

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token es válido
    $sql = "SELECT * FROM recuperacion_contrasena WHERE token = ? AND expires > ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $token, date("U"));
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Restablecer la contraseña
            $nueva_contrasena = $_POST['nueva_contrasena'];
            $confirmar_contrasena = $_POST['confirmar_contrasena'];

            if ($nueva_contrasena === $confirmar_contrasena) {
                // Hashear la nueva contraseña
                $hashed_password = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

                // Actualizar la contraseña en la base de datos
                $row = $result->fetch_assoc();
                $email = $row['email'];
                
                // Actualizar la contraseña del usuario
                $sql = "UPDATE usuarios SET password = ? WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $hashed_password, $email);
                
                if ($stmt->execute()) {
                    echo "Contraseña restablecida exitosamente.";
                } else {
                    echo "Hubo un error al restablecer la contraseña.";
                }
            } else {
                echo "Las contraseñas no coinciden.";
            }
        }
    } else {
        echo "El enlace de recuperación ha caducado o no es válido.";
    }
}
?>
