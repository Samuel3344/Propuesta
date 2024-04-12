<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
  <title>Empresa</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans+Text:500&amp;lang=en">
  <link rel="icon" type="image/ico" href="../stilos/gutter.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="../stilos/styles.css">

  <link href="https://js.radar.com/v4.1.18/radar.css" rel="stylesheet">
  <script src="https://js.radar.com/v4.1.18/radar.min.js"></script>
</head>
<body>
  <div class="container">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <h1>Ingresar clientes</h1>
      <label for="direccion">Dirección</label>
      <div class="direccion-inputs">
        <input type="text" name="direccion" id="autocomplete" oninput="buscarDireccion()">

        <script type="text/javascript">
          Radar.initialize('prj_live_pk_3fb3657217d63247bd62f847d9bdbcf722cc14c6');

          // create autocomplete input
          Radar.ui.autocomplete({
            container: 'autocomplete',
            showMarkers: true,
            markerColor: '#ACBDC8',
            responsive: true,
            width: '600px',
            maxHeight: '600px',
            placeholder: 'Search address',
            limit: 8,
            minCharacters: 3,
            // omit near to use default IP address location
            near: null,
            onSelection: (address) => {
              // do something with selected address
            },
          });
        </script>
      </div>

      <label for="archivo">Subir Archivo</label>
      <input type="file" id="imagen" name="imagen" accept=".png,.jpg,.jpeg">

    <div class="mapouter">
      <div class="gmap_canvas">
        <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=636+5th+Ave%2C+New+York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
      </div>
    </div>

    <style>
      .mapouter {
        position: relative;
        text-align: center;
        width: 100%;
        padding-bottom: 75%; /* Aspect ratio 4:3 */
      }
      .gmap_canvas {
        overflow: hidden;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
      }
    </style>

    <script>
      function buscarDireccion() {
        var direccion = document.getElementById('autocomplete').value;
        var iframe = document.getElementById('gmap_canvas');
        iframe.src = 'https://maps.google.com/maps?q=' + encodeURIComponent(direccion) + '&t=&z=13&ie=UTF8&iwloc=&output=embed';
      }
    </script>
    <button type="submit" name="submit">Enviar</button>
    </form>

    <?php
    // Verificar si se envió el formulario
    if(isset($_POST['submit'])) {
        // Verificar si se ingresó una dirección
        if(empty($_POST['direccion'])) {
            echo '<div class="alert alert-danger" role="alert">Por favor, ingrese una dirección.</div>';
        } else {
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
                    echo '<div class="alert alert-success" role="alert">Los datos se han guardado correctamente.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error al guardar los datos: ' . mysqli_error($conn) . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger">
                      <strong>Error!</strong> Problema con mover el archivo.</div>';
            }
        }
    }
    ?>
  </div>
</body>
</html>
