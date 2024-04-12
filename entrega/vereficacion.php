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

// Declarar la variable $cliente_id para mantenerla disponible fuera del bloque de verificación de formulario
$cliente_id = null;

// Verificar si se envió el formulario
if(isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $celular = $_POST['telefono'];
    $Direccion = $_POST['direccion'];

    // Consulta SQL para verificar los datos en la base de datos
    $sql = "SELECT ID, enlace FROM cliente WHERE Direccion = '$Direccion'";

    // Ejecutar la consulta SQL
    $result = mysqli_query($conn, $sql);

    // Verificar si la consulta SQL se ejecutó correctamente
    if ($result) {
        // Verificar si se encontraron resultados
        if (mysqli_num_rows($result) > 0) {
            // Los datos coinciden, obtener el ID del cliente
            $row = mysqli_fetch_assoc($result);
            $cliente_id = $row['ID']; // Suponiendo que el ID del cliente se llama 'ID'
            $pdf_link = $row['enlace']; // Suponiendo que la columna para la ruta del PDF se llama 'enlace'
            
            // Redirigir al usuario al enlace pdf/prueba.php con el ID del cliente
            header("Location: pdf/prueba.php?pdf=$pdf_link&cliente_id=$cliente_id&nombre=$nombre&celular=$celular");

            exit();
        } else {
            // Los datos no coinciden
            header("Location: ../index.html");
        }
    } else {
        // La consulta SQL falló
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>
