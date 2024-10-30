<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);  // Encriptar la contraseña

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO iniciosecion (nombres, apellidos, correo, contrasena) VALUES ('$nombres', '$apellidos', '$correo', '$contrasena')";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>