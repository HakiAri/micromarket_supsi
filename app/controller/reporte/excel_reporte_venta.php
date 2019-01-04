<?php
require_once('../../config/db.php');
require_once('../../config/conexion.php');
require_once('../../librarys/phpexcel/Classes/PHPExcel.php');
require_once('../../config/route.php');

// Resivimos las variables de fechas

$dateA = date('Y-m-d',strtotime(trim($_REQUEST["fechaConsultaA"])));
$dateB = date('Y-m-d',strtotime(trim($_REQUEST["fechaConsultaB"])));

$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$fechaA = explode("-",$dateA);
$fechaB = explode("-",$dateB);

$objPHPExcel = new PHPExcel();
/**/
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load('templatereporte.xlsx');
//$objPHPExcel = $objReader->load('excel/templateequipmentjob.xlsx');

// Indicamos que se pare en la hoja uno del libro
$objPHPExcel->setActiveSheetIndex(0);


$sql = "call detalleVentasPorRangoFechas('{$dateA}','{$dateB}')";    
//echo $sql;
$res=$con->query($sql);

$line = 10;
$cont = 1;

foreach ($res as $fila)
{
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$line,$cont);

    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$line,$fila['fecha']);

    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$line,$fila['fecha']);

    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$line,$fila['ci']);

    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$line,$fila['nombre']);

    $con= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($con->connect_errno){
            die("imposible conectarse: (".$con->connect_errno.") ".$con->connect_error);
        }
        $sqlaux = "call SumarSeccionesVenta({$fila['id_compra']})";    
        
        $resaux = $con->query($sqlaux);
        $sumaSecciones = 0;
        foreach($resaux as $seccion){

            if($seccion['idseccion'] == 1){
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$line,number_format($seccion['suma'],2));
                $sumaSecciones += $seccion['suma'];
            }

            if($seccion['idseccion'] == 2){
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$line,number_format($seccion['suma'],2));
                $sumaSecciones += $seccion['suma'];
            }

            if($seccion['idseccion'] == 3){
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$line,number_format($seccion['suma'],2));
                $sumaSecciones += $seccion['suma'];
            }

            if($seccion['idseccion'] == 4){
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$line,number_format($seccion['suma'],2));
                $sumaSecciones += $seccion['suma'];
            }

            if($seccion['idseccion'] == 5){
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$line,number_format($seccion['suma'],2));
                $sumaSecciones += $seccion['suma'];
            }
            
            
            /*switch ($seccion['idseccion']) {
                case '1':
                    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$line,number_format($seccion['suma'],2));
                    $sumaSecciones += $seccion['suma'];
                    break;

                case '2':
                    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$line,number_format($seccion['suma'],2));
                    $sumaSecciones += $seccion['suma'];

                case '3':
                    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$line,number_format($seccion['suma'],2));
                    $sumaSecciones += $seccion['suma'];
                    break;
                
                case '4':
                    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$line,number_format($seccion['suma'],2));
                    $sumaSecciones += $seccion['suma']; 
                    break;
                
                case '5':
                    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$line,number_format($seccion['suma'],2));
                    $sumaSecciones += $seccion['suma'];  
                    break;    
                
                default:
                    # code...
                    break;
            }*/
                      
        } 

    $con->close();
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$line,number_format($sumaSecciones,2));
    $line++;
    $cont++;

}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte_ventas_'.date("d-m-Y").'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>