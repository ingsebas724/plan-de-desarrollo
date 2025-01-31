<?php
// Configuración de la base de datos
$servername = "localhost"; // Servidor de la base de datos
$username = "tu_usuario"; // Usuario de la base de datos
$password = "tu_contraseña"; // Contraseña de la base de datos
$dbname = "suscripciones"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se envió el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico del formulario
    $email = $_POST['email'];

    // Validar el correo electrónico
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO suscriptores (email) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "¡Gracias por suscribirte!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Por favor, ingresa un correo electrónico válido.";
    }
} else {
    echo "Método no permitido.";
}

// Cerrar la conexión
$conn->close();
?>