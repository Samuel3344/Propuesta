<?php
// Establecer los detalles de la conexión a la base de datos
$servername = "localhost"; // Nombre del servidor MySQL
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$database = "sistema"; // Nombre de la base de datos

// Crear una conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

// Verificar si se envió el formulario
if(isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $Direccion = $_POST['direccion'];

    // Archivo
    $archivo_nombre = $_FILES['imagen']['name']; // Nombre original del archivo
    $archivo_temp = $_FILES['imagen']['tmp_name']; // Ruta temporal del archivo

    // Ruta de destino para guardar el archivo
    $ruta_destino = '../entrega/pdf/uploads/' . $archivo_nombre;

    // Mover la imagen al directorio de destino en el servidor
    if (move_uploaded_file($archivo_temp, $ruta_destino)) {
        // Cambiar la ruta a la parte relativa
        $ruta_relativa = 'uploads/' . $archivo_nombre;

        // Query para insertar datos en la tabla cliente con la ruta relativa de la imagen
        $sql = "INSERT INTO cliente (Direccion, enlace)
                VALUES ('$Direccion', '$ruta_relativa')";

        // Ejecutar la consulta
        if(mysqli_query($conn, $sql)) {
            echo "Los datos se han guardado correctamente.";
        } else {
            echo "Error al guardar los datos: " . mysqli_error($conn);
        }
    } else {
        echo "Error al mover el archivo al directorio de destino.";
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>
