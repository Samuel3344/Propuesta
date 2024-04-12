<?php
require('fpdf186/fpdf.php');

// Conexión a la base de datos (reemplaza los valores con los de tu servidor)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cliente_id = $_GET['cliente_id'];
$nombre = $_GET['nombre'];
$celular = $_GET['celular'];

// Consulta SQL para obtener los datos del cliente
$sql = "SELECT ID, Direccion,enlace FROM cliente WHERE ID = $cliente_id";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
if ($result->num_rows > 0) {
    // Obtener los datos del cliente
    $row = $result->fetch_assoc();
    $Direccion = $row["Direccion"];
    $enlace = $row["enlace"];
} else {
    // Manejar el caso en que la consulta no devuelve resultados
    echo "No se encontraron resultados para el cliente con ID: $cliente_id";
    exit();
}

$fecha_actual = date('m-d-y');

class PDF extends FPDF
{
    function Tabla()
    {
        // Encabezado de la tabla
        $this->SetFont('Arial','B', 8);
        $this->SetFillColor(211, 211, 211);
        $this->Cell(25, 10, 'TOTAL:', 1);
        $this->Cell(25, 10, 'GUTTER', 1, 0, 'C', true);
        $this->Cell(25, 10, 'SUPER GUTTER', 1, 0, 'C', true);
        $this->Cell(25, 10, 'GUTTER GUARD', 1, 0, 'C', true);
        $this->Cell(25, 10, 'ROOF', 1, 0, 'C', true);
        $this->Cell(25, 10, 'SIDING', 1, 0, 'C', true);
        $this->Cell(45, 10, 'PIPE UNDERGROUND', 1, 0, 'C', true);
        $this->Ln();

        // Celdas de la tabla
        $this->SetFont('Arial', '', 8);
        $this->Cell(25, 10, "INSTALLATION", 1);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(25, 10, 'Yes', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(45, 10, '', 1);
        $this->Ln();

        $this->SetFont('Arial', '', 8);
        $this->Cell(25, 10, "CLEANING", 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(45, 10, '', 1);
        $this->Ln();

        $this->SetFont('Arial', '', 8);
        $this->Cell(25, 10, "REPAIR", 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(45, 10, '', 1);
        $this->Ln();
    }
}

// Crear una instancia de la clase PDF
$pdf = new PDF();
$pdf->AddPage();

$pdf->SetMargins(10, 10, 1);
$pdf->SetAutoPageBreak(true, 1);

$pdf->Image('logo.png', 7, 9, 190);

// Otros contenidos del PDF

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(1);
$pdf->SetY(15);
$pdf->Cell(0, 70, 'Date: '. $fecha_actual, 0, 0);

$pdf->Image('logo2.png', 123, 35, 80, 0);

//Cuadro de fecha
$pdf->SetY(45);
$pdf->SetX(22);
$pdf->Cell(20, 9, '', 1);

//NAME

$pdf->SetY(55);
$pdf->Tabla();

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 20, 'Name: ', 0, 0);

$pdf->SetY(100);
$pdf->SetX(31);
$pdf->Cell(50, 10,''.$nombre , 1);

//TELEFONO
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(83);
$pdf->Cell(0, 12, 'Phone: ', 0, 0);

$pdf->SetY(100);
$pdf->SetX(100);
$pdf->Cell(55, 10, ''.$celular, 1);

//ASIGNATURE AND DATE

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(160);
$pdf->Cell(0, 12, 'Signature and Date: ', 0, 0);

$pdf->SetY(100);
$pdf->SetX(160);
$pdf->Cell(45, 10, '', 1);

$pdf->SetY(110);
$pdf->SetX(160);
$pdf->Cell(45, 10, '', 1);

$pdf->SetY(120);
$pdf->SetX(160);
$pdf->Cell(45, 10, '', 1);

//DIRECCION

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(10);
$pdf->SetY(100);
$pdf->Cell(0, 35, 'Address: ', 0, 0);

$pdf->SetY(111);
$pdf->SetX(31);
$pdf->Cell(124, 10, $Direccion, 1);

//CAMPOS DEL EMAIL

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(10);
$pdf->SetY(112);
$pdf->Cell(0, 35, 'Email: ', 0, 0);

$pdf->SetY(122);
$pdf->SetX(31);
$pdf->Cell(124, 10, '', 1);

//DEPOSIT LINE

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(10);
$pdf->SetY(123);
$pdf->Cell(0, 35, 'Deposit:$', 0, 0);

$pdf->SetY(133);
$pdf->SetX(31);
$pdf->Cell(30, 10, '', 1);

//Check 

$pdf->SetY(137);
$pdf->SetX(65);
$pdf->Cell(5, 5, '', 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(123);
$pdf->SetX(70);
$pdf->Cell(0, 35, 'Check', 0, 0);

// CASH

$pdf->SetY(137);
$pdf->SetX(88);
$pdf->Cell(5, 5, '', 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(123);
$pdf->SetX(93);
$pdf->Cell(0, 35, 'Cash', 0, 0);

//ZELLE

$pdf->SetY(137);
$pdf->SetX(110);
$pdf->Cell(5, 5, '', 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(123);
$pdf->SetX(115);
$pdf->Cell(0, 35, 'Zelle', 0, 0);

//C.Card

$pdf->SetY(137);
$pdf->SetX(130);
$pdf->Cell(5, 5, '', 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(123);
$pdf->SetX(135);
$pdf->Cell(0, 35, 'C.Card', 0, 0);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY(123);
$pdf->SetX(150);
$pdf->Cell(0, 35, '(non refundable)', 0, 0);

//Cuadro de imagen y privacy policy

$pdf->SetY(144);
$pdf->SetX(10);
$pdf->Cell(190, 151, $pdf->Image($enlace, 10, 144, 190, 100), 1);
//seste espacio en blanco porque la imagen se agregará después

//Notas y b6

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY(225);
$pdf->SetX(10);
$pdf->Cell(0, 45, 'Notes:', 0, 0);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY(261);
$pdf->SetX(10);
$pdf->Cell(0, 35, 'By:', 0, 0);

$pdf->SetY(251);
$pdf->SetX(12);
$pdf->Cell(86, 25, '', 1);

$pdf->SetY(281);
$pdf->SetX(12);
$pdf->Cell(86, 11, '', 1);

//Cuadro para encerrar privacy
$pdf->SetY(244);
$pdf->SetX(10);
$pdf->Cell(90, 51, '', 1);

//Cuadro 
$pdf->SetY(251);
$pdf->SetX(12);
$pdf->Cell(86, 25, '', 1);

// segundo cuadro de privacy

$pdf->SetY(244);
$pdf->SetX(100);
$pdf->Cell(100, 51, '', 1);

//privacy policy

$pdf->Image('privacy.png', 101, 253, 98, 0);

$pdf->AddPage();

//Logo de la segunda pagina
$pdf->Image('tabla.png', 10, 15, 180, 0);

$pdf->Image('logo2.png', 123, 15, 80, 0);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY(131);
$pdf->SetX(110);
$pdf->Cell(0, 35, 'Signature', 0, 0);

//Espacio para escribir
$pdf->SetY(140);
$pdf->SetX(130);
$pdf->Cell(60, 15, '', 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY(150);
$pdf->SetX(110);
$pdf->Cell(0, 35, 'Name', 0, 0);

//Espacio para escribir

$pdf->SetY(160);
$pdf->SetX(125);
$pdf->Cell(65, 10, '', 1);

// Salida del PDF
$pdf->Output();
?>
