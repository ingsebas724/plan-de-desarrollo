<?php
// Configuración de la base de datos
$servername = "formulario"; // Servidor de la base de datos
$username = "root"; // Usuario de la base de datos
$dbname = "suscripciones"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el correo electrónico del formulario
$email = $_POST['email'];

// Validar el correo electrónico
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Preparar la consulta SQL
    $sql = "INSERT INTO suscriptores (email) VALUES ('$email')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "¡Gracias por suscribirte!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Por favor, ingresa un correo electrónico válido.";
}

// Cerrar la conexión
$conn->close();
?>