<?php
require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
require_once('../../config/db.php');
require_once('../../config/conexion.php');

/*
	Este ejemplo imprime un
	ticket de venta desde una impresora térmica
*/


/*
	Una pequeña clase para
	trabajar mejor con
	los productos
	Nota: esta clase no es requerida, puedes
	imprimir usando puro texto de la forma
	que tú quieras
*/
class Producto{

	public function __construct($nombre, $precio, $cantidad){
		$this->nombre = $nombre;
		$this->precio = $precio;
		$this->cantidad = $cantidad;
	}
}

/*
	Vamos a simular algunos productos. Estos
	podemos recuperarlos desde $_POST o desde
	cualquier entrada de datos. Yo los declararé
	aquí mismo
*/

$productos = array(
		new Producto("Papas fritas", 10, 1),
		new Producto("Pringles", 22, 2),
		/*
			El nombre del siguiente producto es largo
			para comprobar que la librería
			bajará el texto por nosotros en caso de
			que sea muy largo
		*/
		new Producto("Galletas saladas con un sabor muy salado y un precio excelente", 10, 1.5),
	);

/*
	Aquí, en lugar de "POS-58" (que es el nombre de mi impresora)
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/

$nombre_impresora = "ImpresoraCajaUno";


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);

$nroRecibo = $nroCompra;

/*
	Vamos a imprimir un logotipo
	opcional. Recuerda que esto
	no funcionará en todas las
	impresoras

	Pequeña nota: Es recomendable que la imagen no sea
	transparente (aunque sea png hay que quitar el canal alfa)
	y que tenga una resolución baja. En mi caso
	la imagen que uso es de 250 x 250
*/

# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);

/*
	Intentaremos cargar e imprimir
	el logo
*/
try{
	//$logo = EscposImage::load("logo.png", false);
   // $printer->bitImage($logo);
}catch(Exception $e){/*No hacemos nada si hay error*/}

/*
	Ahora vamos a imprimir un encabezado
*/
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer->text("ORIGINAL". "\n");
$printer->text("\n");
$printer -> selectPrintMode();
$printer->text("Comprobante de entrega del Subsidio". "\n");
$printer->text("------------------------------------------------". "\n");
$printer->text("Nro de Recibo : ".$nroRecibo. "\n");
#La fecha también
$printer->text(date("Y-m-d H:i:s") . "\n");
//Consultamos los Datos del Cliente
try{
	$sqlCliente = "call recibo_cliente({$nroCompra})";
    $resCliente = $con->query($sqlCliente);
}catch(Exception $e){/*No hacemos nada si hay error*/}

$total = 0;
$total_literal = "";
foreach ($resCliente as $value) {
	$printer->text("Benificiaria : ".$value['nombre']. "\n");
	$printer->text("CI : ".$value['ci']. "\n");
	$total = $value['total'];
	$total_literal = $value['total_literal'];
}

$con->close();
/*
	Ahora vamos a imprimir los
	productos
*/
$con= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($con->connect_errno){
        die("imposible conectarse: (".$con->connect_errno.") ".$con->connect_error);
    }

$sqlVenta = "call detalle_venta({$nroCompra})";
$resVenta = $con->query($sqlVenta);

$printer->setJustification(Printer::JUSTIFY_LEFT);
//$items[] = array();
//$items[] = new item("Producto","Cant","Bs","Sub Total");

$idSeccion = 0;
$sumTotal  = 0;
//$items_copy[] = new item("Producto","Cant","Bs","Sub Total");
foreach ($resVenta as $value) {
	//$printer->text($value['nombre'] ."\t".$value['peso_cantidad'] ."\t".$value['precio'] ."\t".$value['preciototal']."\n");
	
	if($value['idseccion'] != $idSeccion){
		
		if($idSeccion != 0){
			$items[] = new item("---------------------","------","-----------","---------");
			$items[] = new item("","","SubTotal:","".$sumTotal);
			$items[] = new item("---------------------","------","-----------","---------");
			$sumTotal = 0;
		}
		
		
		$idSeccion = $value['idseccion'];
		switch ($idSeccion) {
			case '1':
				$items[] = new item("","","","");
				$items[] = new item("CARNES/DERIVADOS","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items[] = new item("Producto","Cant","Bs","Sub Total");
				$items[] = new item("---------------------","------","-----------","---------");
				break;
			case '2':
				$items[] = new item("","","","");
				$items[] = new item("POLLO/PESCADO","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items[] = new item("Producto","Cant","Bs","Sub Total");
				$items[] = new item("---------------------","------","-----------","---------");
				break;
			case '3':
				$items[] = new item("","","","");
				$items[] = new item("VERDURAS","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items[] = new item("Producto","Cant","Bs","Sub Total");
				$items[] = new item("---------------------","------","-----------","---------");
				break;
			case '4':
				$items[] = new item("","","","");
				$items[] = new item("TUBERCULOS","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items[] = new item("Producto","Cant","Bs","Sub Total");
				$items[] = new item("---------------------","------","-----------","---------");
				break;
			case '5':
				$items[] = new item("","","","");
				$items[] = new item("FRUTAS","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items[] = new item("Producto","Cant","Bs","Sub Total");
				$items[] = new item("---------------------","------","-----------","---------");
				break;
			
			default:
				
				break;
		}
	}
	$items[] = new item($value['nombre'],$value['peso_cantidad'] ,$value['precio'] ,$value['preciototal']);
	//$items_copy[] = new item($value['nombre'],$value['peso_cantidad'] ,$value['precio'] ,$value['preciototal']);
	$sumTotal += $value['preciototal'];
}

			$items[] = new item("---------------------","------","-----------","---------");
			$items[] = new item("","","SubTotal:","".$sumTotal);
			$items[] = new item("---------------------","------","-----------","---------");
			$sumTotal = 0;

$i = 0;
foreach ($items as $item) {
	if($i == 0){
		//$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer -> text($item);
		$printer->text("------------------------------------------------". "\n");
		$printer -> selectPrintMode();

	}else{
		$printer -> text($item);
	}
    $i++;
}

# Para mostrar el total
/*$total = 0;
foreach ($productos as $producto) {
	$total += $producto->cantidad * $producto->precio;

	//Alinear a la izquierda para la cantidad y el nombre
	//$printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text($producto->cantidad . "x" . $producto->nombre . "\n");

    //Y a la derecha para el importe
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text(' $' . $producto->precio . "\n");
}*/

/* Clase de para organizar las columnas */
class item
{
    private $producto;
    private $cantidad;
	private $precio;
	private $total;

    public function __construct($producto = '', $cantidad = '',$precio = '', $total = '')
    {
        $this -> producto = $producto;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> total = $total;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 60;
        //if ($this -> dollarSign) {
            $leftCols = $leftCols / 4 - $rightCols / 4;
        //}
		$left = str_pad($this -> producto, 21) ;
		$left1 = str_pad($this -> cantidad, 6) ;
		//$left2 = str_pad($this -> precio, $leftCols, ' ', STR_PAD_LEFT) ;
        //$right = str_pad($this -> total, $rightCols, ' ', STR_PAD_LEFT);
		$left2 = str_pad($this -> precio, 11) ;
		$right = str_pad($this -> total, $rightCols, ' ', STR_PAD_LEFT);

		return "$left$left1$left2$right\n";
    }
}


/*
	Terminamos de imprimir
	los productos, ahora va el total
*/
$printer->text("--------------------------------------------". "\n");
$printer->text("TOTAL: Bs ". $total ."\n");
$printer->text("SON ". $total_literal ."\n");


$printer->text("\n");
$printer->text("\n");
$printer->text("\n");
$printer->text("--------------------------------------------". "\n");
$printer->text("FIRMA DE LA BENEFICIARIA"."\n");
/*
	Podemos poner también un pie de página
*/
$printer->text("Muchas gracias por su preferencia...");



/*Alimentamos el papel 3 veces*/
$printer->feed(3);

/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();

/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
$printer->pulse();

/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();
$con->close();

/**********************************************************************************
 ***************                Recibo de Copea                ********************
***********************************************************************************/
$connectors = new WindowsPrintConnector($nombre_impresora);
$printera = new Printer($connectors);

# Vamos a alinear al centro lo próximo que imprimamos
$printera->setJustification(Printer::JUSTIFY_CENTER);

$con= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($con->connect_errno){
        die("imposible conectarse: (".$con->connect_errno.") ".$con->connect_error);
    }
/*
	Ahora vamos a imprimir un encabezado
*/
$printera -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printera->text("COPIA". "\n");
$printera->text("\n");
$printera -> selectPrintMode();
$printera->text("Comprobante de entrega del Subsidio". "\n");
$printera->text("------------------------------------------------". "\n");
$printera->text("Nro de Recibo : ".$nroRecibo. "\n");
#La fecha también
$printera->text(date("Y-m-d H:i:s") . "\n");
//Consultamos los Datos del Cliente
try{
	$sqlCliente = "call recibo_cliente({$nroCompra})";
    $resCliente = $con->query($sqlCliente);
}catch(Exception $e){/*No hacemos nada si hay error*/}

$total = 0;
$total_literal = "";
foreach ($resCliente as $value) {
	$printera->text("Benificiaria : ".$value['nombre']. "\n");
	$printera->text("CI : ".$value['ci']. "\n");
	$total = $value['total'];
	$total_literal = $value['total_literal'];
}

$printera->text("------------------------------------------------". "\n");
$con->close();
/*
	Ahora vamos a imprimir los
	productos
*/
$con= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($con->connect_errno){
        die("imposible conectarse: (".$con->connect_errno.") ".$con->connect_error);
    }

$sqlVenta = "call detalle_venta({$nroCompra})";
$resVenta = $con->query($sqlVenta);

$printera->setJustification(Printer::JUSTIFY_LEFT);
//$items[] = array();
$idSeccion_copy = 0;
$sumTotal_copy  = 0;
//$items_copy[] = new item("Producto","Cant","Bs","Sub Total");
foreach ($resVenta as $value) {

	if($value['idseccion'] != $idSeccion_copy){

		if($idSeccion_copy != 0){
			$items_copy[] = new item("---------------------","------","-----------","---------");
			$items_copy[] = new item("","","SubTotal:","".$sumTotal_copy);
			$items_copy[] = new item("---------------------","------","-----------","---------");
			$sumTotal_copy = 0;
		}

		$idSeccion_copy = $value['idseccion'];
		switch ($idSeccion_copy) {
			case '1':
				$items_copy[] = new item("","","","");
				$items_copy[] = new item("CARNES/DERIVADOS","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items_copy[] = new item("Producto","Cant","Bs","Sub Total");
				$items_copy[] = new item("---------------------","------","-----------","---------");
				break;
			case '2':
				$items_copy[] = new item("","","","");
				$items_copy[] = new item("POLLO/PESCADO","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items_copy[] = new item("Producto","Cant","Bs","Sub Total");
				$items_copy[] = new item("---------------------","------","-----------","---------");
				break;
			case '3':
				$items_copy[] = new item("","","","");
				$items_copy[] = new item("VERDURAS","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items_copy[] = new item("Producto","Cant","Bs","Sub Total");
				$items_copy[] = new item("---------------------","------","-----------","---------");
				break;
			case '4':
				$items_copy[] = new item("","","","");
				$items_copy[] = new item("TUBERCULOS","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items_copy[] = new item("Producto","Cant","Bs","Sub Total");
				$items_copy[] = new item("---------------------","------","-----------","---------");
				break;
			case '5':
				$items_copy[] = new item("","","","");
				$items_copy[] = new item("FRUTAS","","","");
				//$items[] = new item("---------------------","------","-----------","---------");
				$items_copy[] = new item("Producto","Cant","Bs","Sub Total");
				$items_copy[] = new item("---------------------","------","-----------","---------");
				break;
			
			default:
				break;
		}
	}

	//$printer->text($value['nombre'] ."\t".$value['peso_cantidad'] ."\t".$value['precio'] ."\t".$value['preciototal']."\n");
	$items_copy[] = new item($value['nombre'],$value['peso_cantidad'] ,$value['precio'] ,$value['preciototal']);
	$sumTotal_copy += $value['preciototal'];
}

		$items_copy[] = new item("---------------------","------","-----------","---------");
		$items_copy[] = new item("","","SubTotal:","".$sumTotal_copy);
		$items_copy[] = new item("---------------------","------","-----------","---------");
		$sumTotal_copy = 0;

$ii = 0;
foreach ($items_copy as $item) {
	if($ii == 0){
		//$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printera->setJustification(Printer::JUSTIFY_CENTER);
		$printera-> text($item);
		$printera->text("------------------------------------------------". "\n");
		$printera-> selectPrintMode();

	}else{
		$printera-> text($item);
	}
    $ii++;
}

/*
	Terminamos de imprimir
	los productos, ahora va el total
*/
$printera->text("--------------------------------------------". "\n");
$printera->text("TOTAL: Bs ". $total ."\n");
$printera->text("SON ". $total_literal ."\n");

$printera->text("\n");
$printera->text("\n");
$printera->text("\n");
$printera->text("--------------------------------------------". "\n");
$printera->text("FIRMA DE LA BENIFIARIA"."\n");



/*
	Podemos poner también un pie de página
*/
$printera->text("Muchas gracias por su preferencia...");



/*Alimentamos el papel 3 veces*/
$printera->feed(3);

/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printera->cut();

/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
$printera->pulse();

/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printera->close();
?>