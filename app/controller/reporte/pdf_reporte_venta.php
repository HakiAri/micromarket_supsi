<?php
require_once('../../config/db.php');
require_once('../../config/conexion.php');
require_once('../../librarys/tcpdf/examples/tcpdf_include.php');

// Resivimos las variables de fechas

$dateA = date('Y-m-d', strtotime(trim($_REQUEST["fecha_a"])));
$dateB = date('Y-m-d', strtotime(trim($_REQUEST["fecha_b"])));




// create new PDF document
$dimen = array(216, 280);
// $pdf = new TCPDF('P','mm','A4',true, 'UTF-8', false);
 //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF('L', PDF_UNIT, $dimen, true, 'UTF-8', false);

//$pdf->addFormat('custom',216,280);
// set document information 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Luis Miguel Mendoza Ticona');
$pdf->SetTitle('Reporte');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', 'Proveedora de Alimentos y Servicios', array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced fontñ
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

//Declaramos las columnas
//$posxini = PDF_MARGIN_LEFT+1;
$posxini = 10;
$posxnro = 20;
$posxfec = 40;
$posxval = 55;
$posxci = 75;
$posxnom = 148;
$posxcar = 168;
$posxpol = 190;
$posxfru = 210;
$posxver = 230;
$posxtub = 255;
$posxfin = 271;
// ---------------------------------------------------------
// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.



// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
// set text shadow effect
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Set some content to print

/* La linea rectangular de pagina vertical */
$hidetop = 40;
$tab_top = 40;
$tab_height = 160;
$pdf->SetFillColor(255, 255, 127);

cabezeraReporte($pdf, $dateA, $dateB);
$pdf->SetFont('dejavusans', '', 8, '', true);

//$this->printRect($pdf,$this->marge_gauche, $tab_top, $this->page_largeur-$this->marge_gauche-$this->marge_droite, $tab_height, $hidetop, $hidebottom);
//rectangulo que cubre la tabla de los datos 
$pdf->Rect(10, $tab_top, 260, $tab_height, 'D');

if (!empty($hidetop)) {

    $pdf->SetXY($posxini, $tab_top + 10);
    $pdf->MultiCell($posxnro - $posxini - 1, 7, "Nro", '', 'C');
    $pdf->line($posxnro - 1, $tab_top, $posxnro - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxnro - 1, $tab_top + 10);
    $pdf->MultiCell($posxfec - $posxnro - 1, 2, "FECHA", '', 'C');
    $pdf->line($posxfec - 1, $tab_top, $posxfec - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxfec - 1, $tab_top + 10);
    $pdf->MultiCell($posxval - $posxfec - 1, 2, "N° VALE", '', 'C');
    $pdf->line($posxval - 1, $tab_top, $posxval - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxval - 1, $tab_top + 10);
    $pdf->MultiCell($posxci - $posxval - 1, 2, "CI", '', 'C');
    $pdf->line($posxci - 1, $tab_top, $posxci - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxci - 1, $tab_top + 10);
    $pdf->MultiCell($posxnom - $posxci - 1, 2, "NOMBRE BENEFICIARIA", '', 'C');
    $pdf->line($posxnom - 1, $tab_top, $posxnom - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxnom - 1, $tab_top + 11);
    $pdf->MultiCell($posxcar - $posxnom - 1, 2, "CARNES Y DERIVADOS", '', 'C');
    $pdf->line($posxcar - 1, $tab_top + 8, $posxcar - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxcar - 1, $tab_top + 11);
    $pdf->MultiCell($posxpol - $posxcar - 1, 2, "POLLO Y/O PESCADO", '', 'C');
    $pdf->line($posxpol - 1, $tab_top + 8, $posxpol - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxpol - 1, $tab_top + 11);
    $pdf->MultiCell($posxfru - $posxpol - 1, 2, "VERDURAS", '', 'C');
    $pdf->line($posxfru - 1, $tab_top + 8, $posxfru - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxfru - 1, $tab_top + 11);
    $pdf->MultiCell($posxver - $posxfru - 1, 2, "TUBERCULOS", '', 'C');
    $pdf->line($posxver - 1, $tab_top + 8, $posxver - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxver - 1, $tab_top + 11);
    $pdf->MultiCell($posxtub - $posxver - 1, 2, "FRUTAS", '', 'C');
    $pdf->line($posxtub - 1, $tab_top, $posxtub - 1, $tab_top + $tab_height);

    $pdf->SetXY($posxtub - 1, $tab_top + 10);
    $pdf->MultiCell($posxfin - $posxtub - 1, 2, "TOTAL", '', 'C');
        
        //$pdf->line($posxfin-1, $tab_top, $posxfin-1, $tab_top + $tab_height);
        //$pdf->line(20, $tab_top+10, 216-21, $tab_top+10);

        //Linea para los titulos de las cabeceras
    $pdf->line($posxini, 60, $posxfin - 1, 60);

    $pdf->SetXY($posxnom - 1, $tab_top + 2);
    $pdf->MultiCell($posxtub - $posxnom - 1, 2, "PRODUCTOS ENTREGADOS", '', 'C');
        //Linea para las Secciones
    $pdf->line($posxnom - 1, 48, $posxtub - 1, 48);
}


$sql = "call detalleVentasPorRangoFechas('{$dateA}','{$dateB}')";    
    //echo $sql;
$res = $con->query($sql);

$limitefilas = 28;
$linea = 1;

    //$iniY = 30;
$curY = $tab_top + 20;
$nexY = 30;
$total_ventas = 0;
$cont = 1;

foreach ($res as $fila) {

        //$pdf->Rect(20, $tab_top, 175, $tab_top + $tab_height+10, 'D');

    $pdf->SetXY($posxini + 1, $curY);
    $pdf->MultiCell($posxnro - $posxini - 1, 1, $cont, 0, 'L', 0);

    $pdf->SetXY($posxnro, $curY);
    $pdf->MultiCell($posxfec - $posxnro - 1, 1, $fila['fecha'], 0, 'R', 0);

    $pdf->SetXY($posxfec, $curY);
    $pdf->MultiCell($posxval - $posxfec - 1, 1, $cont, 0, 'C', 0);

    $pdf->SetXY($posxval, $curY);
    $pdf->MultiCell($posxci - $posxval - 1, 1, $fila['ci'], 0, 'C', 0);

    $pdf->SetXY($posxci, $curY);
    $pdf->MultiCell($posxnom - $posxci - 1, 1, $fila['nombre'], 0, 'L', 0);


    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_errno) {
        die("imposible conectarse: (" . $con->connect_errno . ") " . $con->connect_error);
    }
    $sqlaux = "call SumarSeccionesVenta({$fila['id_compra']})";

    $resaux = $con->query($sqlaux);
        //print_r ($resaux);

    $sumaSecciones = 0;

    foreach ($resaux as $seccion) {

        switch ($seccion['idseccion']) {
            case 1:
                $pdf->SetXY($posxnom, $curY);
                $pdf->MultiCell($posxcar - $posxnom - 1, 1, round($seccion['suma'], 2), 0, 'C', 0);
                $sumaSecciones += $seccion['suma'];
                break;

            case 2:
                $pdf->SetXY($posxcar, $curY);
                $pdf->MultiCell($posxpol - $posxcar - 1, 1, round($seccion['suma'], 2), 0, 'C', 0);
                $sumaSecciones += $seccion['suma'];
                break;

            case 3:
                $pdf->SetXY($posxpol, $curY);
                $pdf->MultiCell($posxfru - $posxpol - 1, 1, round($seccion['suma'], 2), 0, 'C', 0);
                $sumaSecciones += $seccion['suma'];
                break;

            case 4:
                $pdf->SetXY($posxfru, $curY);
                $pdf->MultiCell($posxver - $posxfru - 1, 1, round($seccion['suma'], 2), 0, 'C', 0);
                $sumaSecciones += $seccion['suma'];
                break;

            case 5:
                $pdf->SetXY($posxver, $curY);
                $pdf->MultiCell($posxtub - $posxver - 1, 1, round($seccion['suma'], 2), 0, 'C', 0);
                $sumaSecciones += $seccion['suma'];
                break;

            default:
                    # code...
                break;
        }

    }

    $con->close();

    $pdf->SetXY($posxtub, $curY);
    $pdf->MultiCell($posxfin - $posxtub - 1, 1, round($sumaSecciones, 2), 0, 'R', 0);

    $cont++;

        //$nexY = $pdf->GetX();
        //$curY = $nexY + 1;
    $nexY = $curY + 5;
    $linea++;
        //Linea para dividir los registros
        //$pdf->line($posxini, $curY+4, $posxfin-1, $curY+4);
    $curY = $nexY;
        //$nexY = $curY;

    if ($nexY > 189){
    //if ($linea > $limitefilas) {
        //Dibujamos el rectangulo para cubrir los datos
        //$pdf->Rect(10, $tab_top, 260, $nexY, 'D');
      
        $pdf->AddPage();
        $curY = $tab_top + 20;
        $nexY = 30;
        $linea = 1;
        if (!empty($hidetop)) {
            $pdf->SetXY($posxini, $tab_top + 10);
            $pdf->MultiCell($posxnro - $posxini - 1, 7, "Nro", '', 'C');
            $pdf->line($posxnro - 1, $tab_top, $posxnro - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxnro - 1, $tab_top + 10);
            $pdf->MultiCell($posxfec - $posxnro - 1, 2, "FECHA", '', 'C');
            $pdf->line($posxfec - 1, $tab_top, $posxfec - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxfec - 1, $tab_top + 10);
            $pdf->MultiCell($posxval - $posxfec - 1, 2, "N° VALE", '', 'C');
            $pdf->line($posxval - 1, $tab_top, $posxval - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxval - 1, $tab_top + 10);
            $pdf->MultiCell($posxci - $posxval - 1, 2, "CI", '', 'C');
            $pdf->line($posxci - 1, $tab_top, $posxci - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxci - 1, $tab_top + 10);
            $pdf->MultiCell($posxnom - $posxci - 1, 2, "NOMBRE BENEFICIARIA", '', 'C');
            $pdf->line($posxnom - 1, $tab_top, $posxnom - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxnom - 1, $tab_top + 11);
            $pdf->MultiCell($posxcar - $posxnom - 1, 2, "CARNES Y DERIVADOS", '', 'C');
            $pdf->line($posxcar - 1, $tab_top + 8, $posxcar - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxcar - 1, $tab_top + 11);
            $pdf->MultiCell($posxpol - $posxcar - 1, 2, "POLLO Y/O PESCADO", '', 'C');
            $pdf->line($posxpol - 1, $tab_top + 8, $posxpol - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxpol - 1, $tab_top + 11);
            $pdf->MultiCell($posxfru - $posxpol - 1, 2, "VERDURAS", '', 'C');
            $pdf->line($posxfru - 1, $tab_top + 8, $posxfru - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxfru - 1, $tab_top + 11);
            $pdf->MultiCell($posxver - $posxfru - 1, 2, "TUBERCULOS", '', 'C');
            $pdf->line($posxver - 1, $tab_top + 8, $posxver - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxver - 1, $tab_top + 11);
            $pdf->MultiCell($posxtub - $posxver - 1, 2, "FRUTAS", '', 'C');
            $pdf->line($posxtub - 1, $tab_top, $posxtub - 1, $tab_top + $tab_height);

            $pdf->SetXY($posxtub - 1, $tab_top + 10);
            $pdf->MultiCell($posxfin - $posxtub - 1, 2, "TOTAL", '', 'C');
                 
                //$pdf->line($posxfin-1, $tab_top, $posxfin-1, $tab_top + $tab_height);
                //$pdf->line(20, $tab_top+10, 216-21, $tab_top+10);
            
                //Linea para los titulos de las cabeceras
            $pdf->line($posxini, 60, $posxfin - 1, 60);

            $pdf->SetXY($posxnom - 1, $tab_top + 2);
            $pdf->MultiCell($posxtub - $posxnom - 1, 2, "PRODUCTOS ENTREGADOS", '', 'C');
                //Linea para las Secciones
            $pdf->line($posxnom - 1, 48, $posxtub - 1, 48);

            cabezeraReporte($pdf, $dateA, $dateB);
            $pdf->SetFont('dejavusans', '', 8, '', true);
            $pdf->Rect(10, $tab_top, 260, $tab_height, 'D');
        }

    }

}    

// ---------------------------------------------------------

function cabezeraReporte($pdf, $dateA, $dateB)
{

    $pdf->SetFont('dejavusans', '', 11, '', true);
    $pdf->SetXY(20, 10);
    $pdf->Image('../../../resources/assets/images/logopas.png', '', '', 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

    $posxini = 55;
    $posxfin = 230;

    $pdf->SetXY(55, 20);
    $pdf->MultiCell($posxfin - $posxini, 7, "CONCILIACION DE ENTREGA DE PRODUCTOS DE CANAL HORIZONTAL SUBSIDIO PRENATAL Y LACTANCIA URBANO", '', 'C', 0, 0, '', '', true);

    $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $fechaA = explode("-", $dateA);
    $fechaB = explode("-", $dateB);

    $pdf->SetXY(55, 35);
    $pdf->MultiCell($posxfin - $posxini, 7, "DEL : " . $fechaA[2] . " de " . $meses[$fechaA[1] - 1] . " de " . $fechaA[0] . " AL " . $fechaB[2] . " de " . $meses[$fechaB[1] - 1] . " de " . $fechaB[0], '', 'C', 0, 0, '', '', true);
}
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('ReporteEntregaSubsidios_' . date("d-m-Y") . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
