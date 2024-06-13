<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class ActaArchivoController extends Controller
{
    public function actInspeccionInterna($idSol=null)
    {
    	// dd($solnro);
    	// $ts = TSolicitud::where('solnro',$solnro)->first();
    	// dd($idSol);
    	$ts='';
    	
    	$marco = 1;
    	$smarco = 0;
    	$blanco = '';
    	$fondo = true;
    	$tam = 3.5;

    	$pdf = new Fpdf('P','mm','a4');
    	$pdf->SetFont('Arial','',6);
		$pdf->AddPage();
		// --------------------------------cabecera
		$pdf->SetFont('Arial','',13);
		$pdf->Cell(110,25,utf8_decode('-'),$smarco,0,'C');
		$pdf->text(55,18,utf8_decode('FORMATO 5A'));
		$pdf->text(20,25,utf8_decode('EMUSAP S.A.C'));
		$pdf->text(20,32,utf8_decode('ACTA INSPECCION INTERNA'));

	$pdf->rect(120,10,80,25);
		$pdf->SetFont('Arial','',13);
		$pdf->Cell(0,25,utf8_decode('-'),$smarco,1,'L');
		$pdf->text(125,18,utf8_decode('Nª Reclamo:'));
		$pdf->text(175,18,utf8_decode('2022-1703'));
		$pdf->SetFont('Arial','',9);
		$pdf->text(125,23,utf8_decode('INSCRIPCION: 00001508'));
		$pdf->text(125,28,utf8_decode('COD.CAT. 1-1-2-22-3840-0'));
		$pdf->text(125,33,utf8_decode('Fecha:'));
		$pdf->text(185,33,utf8_decode('14/10/22'));
		// cliente
	$pdf->rect(10,35,190,5.5);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(30,$tam+2,utf8_decode('Cliente'),$smarco,0,'L');
		$pdf->Cell(80,$tam+2,utf8_decode('PALOMINO RIOS ALEJANDRINO'),$smarco,0,'L');
		$pdf->Cell(10,$tam+2,utf8_decode('D.N.I'),$smarco,0,'L');
		$pdf->Cell(30,$tam+2,utf8_decode('23435465'),$smarco,0,'L');
		$pdf->Cell(10,$tam+2,utf8_decode('R.U.C'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode('23435465111'),$smarco,1,'L');
		// --
	$pdf->rect(10,40.5,190,11);
		$pdf->Cell(30,$tam+2,utf8_decode('Direccion'),$smarco,0,'L');
		$pdf->Cell(100,$tam+2,utf8_decode('AV NUÑEZ #127'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode('Telefono: 965852565'),$smarco,1,'L');

		$pdf->Cell(30,$tam+2,utf8_decode('Urb:'),$smarco,0,'L');
		$pdf->Cell(50,$tam+2,utf8_decode('CASCO URBANO'),$smarco,0,'L');
		$pdf->Cell(20,$tam+2,utf8_decode('Provincia:'),$smarco,0,'L');
		$pdf->Cell(35,$tam+2,utf8_decode('ABANCAY'),$smarco,0,'L');
		$pdf->Cell(20,$tam+2,utf8_decode('Distrito:'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode('ABANCAY'),$smarco,1,'L');
		// razon social
	$pdf->rect(10,51.5,190,5.5);
		$pdf->Cell(30,$tam+2,utf8_decode('RAZON SOCIAL:'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode('Empresa de turismo'),$smarco,1,'L');
		// datos de Medidor
	$pdf->rect(10,57,190,5.5);
		$pdf->Cell(30,$tam+2,utf8_decode('MEDIDOR Nª:'),$smarco,0,'L');
		$pdf->Cell(35,$tam+2,utf8_decode('FA21020121'),$smarco,0,'L');
		$pdf->Cell(30,$tam+2,utf8_decode('DIAMETRO (MM):'),$smarco,0,'L');
		$pdf->Cell(35,$tam+2,utf8_decode('1/2 "'),$smarco,0,'L');
		$pdf->Cell(30,$tam+2,utf8_decode('ULTIMA LECTURA:'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');
		$pdf->Ln(2);
		// tipo de unidades de uso
		$pdf->Cell(65,$tam,utf8_decode('TIPO DE UNIDADES DE USO:'),$smarco,0,'L');
		$pdf->Cell(25,$tam,utf8_decode('Social'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('Domestico'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('Comercial'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('Industrial'),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode('Estatal'),$marco,1,'C');
		$pdf->rect(75,58+10,25,7);
		$pdf->rect(100,58+10,25,7);
		$pdf->rect(125,58+10,25,7);
		$pdf->rect(150,58+10,25,7);
		$pdf->rect(175,58+10,25,7);
		$pdf->Ln(5);
		$pdf->Cell(0,$tam,utf8_decode('Nª de conexiones asociadas:'),$smarco,1,'L');
		$pdf->Cell(0,$tam,utf8_decode('ACTUALIZACION DE DATOS DEL PREDIO: Ubicacion del predio:'),$smarco,1,'L');
		// primera cuadricula
		$pdf->Ln(3);
$pdf->rect(10,81,190,47);
	$pdf->rect(17,83,176,8.5);
		$pdf->Cell(7,$tam+5,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(71,$tam+5,utf8_decode('-'),$smarco,0,'C');
		$pdf->Cell(45,$tam+5,utf8_decode('-'),$smarco,0,'C');
		$pdf->Cell(30,$tam+5,utf8_decode('-'),$smarco,0,'C');
		$pdf->Cell(30,$tam+5,utf8_decode('-'),$smarco,0,'C');
		$pdf->Cell(0,$tam+5,utf8_decode(''),$smarco,1,'C');

	$pdf->rect(17,91.5,176,3.4);
		$pdf->Cell(7,$tam,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(71,$tam,utf8_decode('(Calle, Jiron, Avenida)'),$smarco,0,'C');
		$pdf->Cell(45,$tam,utf8_decode('Nª'),$smarco,0,'C');
		$pdf->Cell(30,$tam,utf8_decode('Mz.'),$smarco,0,'C');
		$pdf->Cell(30,$tam,utf8_decode('Lote.'),$smarco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'C');

		// $pdf->Ln(5);
	$pdf->rect(17,94.9,176,8.5);
		$pdf->Cell(7,$tam+5,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(76,$tam+5,utf8_decode('-'),$smarco,0,'C');
		$pdf->Cell(55,$tam+5,utf8_decode('-'),$smarco,0,'C');
		$pdf->Cell(45,$tam+5,utf8_decode('-'),$smarco,0,'C');
		$pdf->Cell(0,$tam+5,utf8_decode('-'),$smarco,1,'C');

	$pdf->rect(17,103.4,176,3.4);
		$pdf->Cell(7,$tam,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(76,$tam,utf8_decode('Urbanizacion, Barrio'),$smarco,0,'C');
		$pdf->Cell(55,$tam,utf8_decode('Provincia'),$smarco,0,'C');
		$pdf->Cell(45,$tam,utf8_decode('Distrito'),$smarco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'C');

		$pdf->Ln(25);

		// PRIMER  CUADROS FLOTANTES

		$pdf->text(17,108+3,utf8_decode('TIPO DE UNIDADES DE USO'));
		$pdf->text(17,112+3,utf8_decode('Nª de conexiones asociadas'));
		$pdf->text(45.5,117+3,utf8_decode('Ocupadas'));
		$pdf->text(42,121+3,utf8_decode('Desocupadas'));

		$pdf->text(65,112+3,utf8_decode('SOC'));
		$pdf->text(80,112+3,utf8_decode('DOM'));
		$pdf->text(95,112+3,utf8_decode('COM'));
		$pdf->text(110,112+3,utf8_decode('IND'));
		$pdf->text(125,112+3,utf8_decode('COM'));
		$pdf->rect(60,109.5+3,15,3.4);
		$pdf->rect(75,109.5+3,15,3.4);
		$pdf->rect(90,109.5+3,15,3.4);
		$pdf->rect(105,109.5+3,15,3.4);
		$pdf->rect(120,109.5+3,15,3.4);

		$pdf->rect(60,113+3,15,5);
		$pdf->rect(75,113+3,15,5);
		$pdf->rect(90,113+3,15,5);
		$pdf->rect(105,113+3,15,5);
		$pdf->rect(120,113+3,15,5);

		$pdf->rect(60,118+3,15,5);
		$pdf->rect(75,118+3,15,5);
		$pdf->rect(90,118+3,15,5);
		$pdf->rect(105,118+3,15,5);
		$pdf->rect(120,118+3,15,5);

		$pdf->text(138,112+3,utf8_decode('Estado del abastecimiento durante la inspeccion:'));
		$pdf->text(147,116.5+3,utf8_decode('Normal'));
		$pdf->text(171,116.5+3,utf8_decode('Sin abastecimiento'));
		$pdf->rect(138,113+3,28,5);
		$pdf->rect(166,113+3,28,5);
		$pdf->rect(138,118+3,28,5);
		$pdf->rect(166,118+3,28,5);

		// tabla grande
$pdf->rect(10,130,190,55);
		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('DETALLE DE LA INSPECCION DE LAS INSTALACIONES SANITARIAS INTERIORES:'),$smarco,1,'L');
		$pdf->Ln(3);
		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Estado'),$marco,0,'L');
		$pdf->Cell(17.5,$tam,utf8_decode('Inodoro'),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode('Lavatorio'),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode('Ducha'),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode('Urinario'),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode('Bidet'),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode('Grifo'),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode('Cisterna'),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode('Tanque'),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode('Piscina'),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'C');

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Con fuga'),$marco,0,'L');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'C');

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Reparado'),$marco,0,'L');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'C');

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Clausurado'),$marco,0,'L');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'C');

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Totales'),$marco,0,'L');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(17.5,$tam,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'C');

		$pdf->Ln(2);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('OBSERVACIONES:'),$smarco,1,'L');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(180,$tam+2,utf8_decode('.....................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(180,$tam+2,utf8_decode('.....................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');
		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(180,$tam+2,utf8_decode('.....................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');
		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(180,$tam+2,utf8_decode('.....................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L'); 
		
$pdf->rect(10,193,190,32);
		$pdf->SetFont('Arial','',7);

		$pdf->Ln(4);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('DATOS DE PERSONA PRESENTE EN LA INSPECCION'),$smarco,1,'L');

		$pdf->Ln(5);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(60,$tam,utf8_decode('Nombre de la persona presente en la inspeccion:'),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('...........................................................................................................................................................................'),$smarco,1,'L');
		$pdf->Ln(1);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Propietario:'),$smarco,0,'L');
		$pdf->Cell(30,$tam,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(15,$tam,utf8_decode('Inquilino:'),$smarco,0,'L');
		$pdf->Cell(30,$tam,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(15,$tam,utf8_decode('Residente:'),$smarco,0,'L');
		$pdf->Cell(30,$tam,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(10,$tam,utf8_decode('Otro:'),$smarco,0,'L');
		$pdf->Cell(30,$tam,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'L');
		$pdf->Ln(1);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(65,$tam,utf8_decode('Numero de documento de identidad (DNI, LE, CI):'),$smarco,0,'L');
		$pdf->Cell(115,$tam,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'L');
		$pdf->Ln(1);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('OBSERVACIONES:'),$smarco,1,'L');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(180,$tam+2,utf8_decode('.....................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');
		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(180,$tam+2,utf8_decode('.....................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');

		$pdf->SetFont('Arial','',7);

		$pdf->Ln(5);

		$pdf->Cell(60,$tam+12,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(5,$tam+12,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(60,$tam+12,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(5,$tam+12,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(60,$tam+12,utf8_decode(''),$marco,1,'L');

		$pdf->Cell(60,$tam+2,utf8_decode('FIRMA DEL USUARIO (*)'),$smarco,0,'C');
		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(60,$tam+2,utf8_decode('INSPECTOR/OPERARIO/SUPERVISOR'),$smarco,0,'C');
		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(60,$tam+2,utf8_decode('SERVICIO TECNICO'),$smarco,1,'C');

		$pdf->Cell(60,$tam,utf8_decode('FECHA:'),$smarco,0,'L');
		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(60,$tam,utf8_decode('HORA INICIO:'),$smarco,0,'L');
		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(60,$tam,utf8_decode('HORA FINAL:'),$smarco,1,'L');

		$pdf->Ln(5);
		$pdf->Cell(0,$tam,utf8_decode('*   OBSERVACION: L firma no implica acuerdo con el contenido del acta.'),$smarco,1,'L');

		// $pdf->Ln(20);

		$pdf->Output();

        exit;
    }
    public function actInspeccionExterna($idSol=null)
    {
    	// dd($solnro);
    	// $ts = TSolicitud::where('solnro',$solnro)->first();
    	// dd($idSol);
    	$ts='';
    	
    	$marco = 1;
    	$smarco = 0;
    	$blanco = '';
    	$fondo = true;
    	$tam = 3.5;

    	$pdf = new Fpdf('P','mm','a4');
    	$pdf->SetFont('Arial','',6);
		$pdf->AddPage();
		// --------------------------------cabecera
		$pdf->SetFont('Arial','',13);
		$pdf->Cell(110,25,utf8_decode('-'),$smarco,0,'C');
		$pdf->text(55,18,utf8_decode('FORMATO 5B'));
		$pdf->text(20,25,utf8_decode('EMUSAP S.A.C'));
		$pdf->text(20,32,utf8_decode('ACTA INSPECCION EXTERNA'));

	$pdf->rect(120,10,80,25);
		$pdf->SetFont('Arial','',13);
		$pdf->Cell(0,25,utf8_decode('-'),$smarco,1,'L');
		$pdf->text(125,18,utf8_decode('Nª Reclamo:'));
		$pdf->text(175,18,utf8_decode('2022-1703'));
		$pdf->SetFont('Arial','',9);
		$pdf->text(125,23,utf8_decode('INSCRIPCION: 00001508'));
		$pdf->text(125,28,utf8_decode('COD.CAT. 1-1-2-22-3840-0'));
		$pdf->text(125,33,utf8_decode('Fecha:'));
		$pdf->text(185,33,utf8_decode('14/10/22'));
		// cliente
	$pdf->rect(10,35,190,5.5);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(30,$tam+2,utf8_decode('Cliente'),$smarco,0,'L');
		$pdf->Cell(80,$tam+2,utf8_decode('PALOMINO RIOS ALEJANDRINO'),$smarco,0,'L');
		$pdf->Cell(10,$tam+2,utf8_decode('D.N.I'),$smarco,0,'L');
		$pdf->Cell(30,$tam+2,utf8_decode('23435465'),$smarco,0,'L');
		$pdf->Cell(10,$tam+2,utf8_decode('R.U.C'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode('23435465111'),$smarco,1,'L');
		// --
	$pdf->rect(10,40.5,190,11);
		$pdf->Cell(30,$tam+2,utf8_decode('Direccion'),$smarco,0,'L');
		$pdf->Cell(100,$tam+2,utf8_decode('AV NUÑEZ #127'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode('Telefono: 965852565'),$smarco,1,'L');

		$pdf->Cell(30,$tam+2,utf8_decode('Urb:'),$smarco,0,'L');
		$pdf->Cell(50,$tam+2,utf8_decode('CASCO URBANO'),$smarco,0,'L');
		$pdf->Cell(20,$tam+2,utf8_decode('Provincia:'),$smarco,0,'L');
		$pdf->Cell(35,$tam+2,utf8_decode('ABANCAY'),$smarco,0,'L');
		$pdf->Cell(20,$tam+2,utf8_decode('Distrito:'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode('ABANCAY'),$smarco,1,'L');
		// razon social
	$pdf->rect(10,51.5,190,5.5);
		$pdf->Cell(30,$tam+2,utf8_decode('RAZON SOCIAL:'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode('Empresa de turismo'),$smarco,1,'L');
		// datos de Medidor
	$pdf->rect(10,57,190,7.5);
		$pdf->Cell(30,$tam+4,utf8_decode('MEDIDOR Nª:'),$smarco,0,'L');
		$pdf->Cell(35,$tam+4,utf8_decode('FA21020121'),$smarco,0,'L');
		$pdf->Cell(30,$tam+4,utf8_decode('DIAMETRO (MM):'),$smarco,0,'L');
		$pdf->Cell(15,$tam+4,utf8_decode('1/2 "'),$smarco,0,'L');
		$pdf->Cell(25,$tam+4,utf8_decode('ULTIMA LECTURA:'),$smarco,0,'L');
		$pdf->Cell(0,$tam+4,utf8_decode(''),$smarco,1,'L');

		$pdf->text(170,60,utf8_decode('FUNCIONA:'));
		$pdf->text(165.5,63.5,utf8_decode('NO FUNCIONA:'));
		$pdf->rect(163,57,21.5,3.8);
		$pdf->rect(163,60.8,21.5,3.7);
		$pdf->rect(184.5,57,15.5,3.8);

		// sobre caja
		$pdf->Ln(2);
		$pdf->Cell(45,$tam,utf8_decode('FUGA EN LA CAJA'),$smarco,0,'L');
		$pdf->Cell(76,$tam,utf8_decode('EN CASO DE HABER FUGA EN LA CAJA'),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('OBSERVACIONES SOBRE EL MEDIDOR:'),$smarco,1,'L');
		$pdf->Ln(2);

		$pdf->rect(30,72,10,6);
		$pdf->rect(30,78,10,6);
		$pdf->SetFont('Arial','',10);
		$pdf->text(25,76,utf8_decode('SI'));
		$pdf->text(24,82,utf8_decode('NO'));
		$pdf->SetFont('Arial','',7);


		$pdf->Cell(45,$tam+5,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(38,$tam+5,utf8_decode('-'),$marco,0,'L');
		$pdf->Cell(38,$tam+5,utf8_decode('-'),$marco,0,'L');
		$pdf->Cell(0,$tam+5,utf8_decode(''),$smarco,1,'L');

		$pdf->Cell(45,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(38,$tam,utf8_decode('Antes del medidor'),$marco,0,'L');
		$pdf->Cell(38,$tam,utf8_decode('Despues del medidor'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->text(135,74,utf8_decode('.............................................................'));
		$pdf->text(135,78,utf8_decode('.............................................................'));
		$pdf->text(135,82,utf8_decode('.............................................................'));
		$pdf->text(135,86,utf8_decode('.............................................................'));

		$pdf->SetFont('Arial','',7);

		$pdf->Ln(4);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('UBICACION DE LA CAJA DEL MEDIDOR:'),$smarco,1,'L');

		$pdf->Ln(2);

		$pdf->Cell(5,$tam+5,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(0,$tam+5,utf8_decode(''),$smarco,1,'L');

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(17,$tam,utf8_decode('Interior'),$marco,0,'L');
		$pdf->Cell(17,$tam,utf8_decode('Vereda'),$marco,0,'L');
		$pdf->Cell(17,$tam,utf8_decode('Frente'),$marco,0,'L');
		$pdf->Cell(17,$tam,utf8_decode('Lateral'),$marco,0,'L');
		$pdf->Cell(17,$tam,utf8_decode('Pista'),$marco,0,'L');
		$pdf->Cell(17,$tam,utf8_decode('Distante'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'L');

		$pdf->Ln(2);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(44,$tam,utf8_decode('ESTADO DEL SUMINISTRO:'),$smarco,0,'L');
		$pdf->Cell(80,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('TIPO DE ABASTECIMIENTO:'),$smarco,1,'L');

		$pdf->Ln(2);

		$pdf->Cell(5,$tam+5,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(17,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(5,$tam+5,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(20.5,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(20.5,$tam+5,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(20.5,$tam+5,utf8_decode(''),$marco,1,'L');

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(17,$tam,utf8_decode('Vigente'),$marco,0,'C');
		$pdf->Cell(17,$tam,utf8_decode('Cerrado'),$marco,0,'C');
		$pdf->Cell(17,$tam,utf8_decode('Tapado'),$marco,0,'C');
		$pdf->Cell(17,$tam,utf8_decode('Directo'),$marco,0,'C');
		$pdf->Cell(17,$tam,utf8_decode('Retirado'),$marco,0,'C');
		$pdf->Cell(17,$tam,utf8_decode('No Ubicado'),$marco,0,'C');
		$pdf->Cell(17,$tam,utf8_decode('Niple'),$marco,0,'C');
		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(20.5,$tam,utf8_decode('Continuo'),$marco,0,'C');
		$pdf->Cell(20.5,$tam,utf8_decode('Discontinuo'),$marco,0,'C');
		$pdf->Cell(20.5,$tam,utf8_decode('Nª de horas'),$marco,1,'C');

		$pdf->Ln(4);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode('OBSERVACIONES SOBRE EL SUMNISTRO:'),$smarco,1,'L');

		$pdf->Ln(2);

		$pdf->SetFont('Arial','',10);

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(175,$tam+2,utf8_decode('................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(175,$tam+2,utf8_decode('................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(175,$tam+2,utf8_decode('................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(175,$tam+2,utf8_decode('................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');

		$pdf->Ln(4);

		$pdf->SetFont('Arial','',7);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode('CIERRES Y REAPERTURAS / INSECCION DE SERVICIOS CERRADOS:'),$smarco,1,'L');

		$pdf->Ln(2);

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(40,$tam+2,utf8_decode('Codigo de acceso'),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode('Fecha'),$marco,0,'C');
		$pdf->Cell(25,$tam+2,utf8_decode('Lectura'),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode('Operario'),$marco,0,'C');
		$pdf->Cell(30,$tam+2,utf8_decode('Comentarios'),$marco,0,'C');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'C');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode('Actividad'),$marco,0,'L');
		$pdf->Cell(40,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(25,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(30,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'C');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode('Cierre'),$marco,0,'L');
		$pdf->Cell(40,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(25,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(30,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'C');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode('Reapertura'),$marco,0,'L');
		$pdf->Cell(40,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(25,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(30,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'C');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode('Supervision'),$marco,0,'L');
		$pdf->Cell(40,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(25,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(20,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(30,$tam+2,utf8_decode(''),$marco,0,'C');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'C');

		$pdf->Ln(2);
		
		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'C');

$pdf->rect(10,200,190,39);
		$pdf->Cell(0,$tam,utf8_decode('DATOS DE PERSONA PRESENTE EN LA INSPECCION:'),$smarco,1,'L');

		$pdf->Ln(3);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(56,$tam,utf8_decode('Nombre de la persona presente en la inspeccion:'),$smarco,0,'L');
		$pdf->Cell(85,$tam,utf8_decode('........................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(17,$tam,utf8_decode('Reclamante:'),$smarco,0,'L');
		$pdf->Cell(5,$tam,utf8_decode('SI'),$smarco,0,'L');
		$pdf->Cell(8,$tam,utf8_decode('..........'),$smarco,0,'L');
		$pdf->Cell(5,$tam,utf8_decode('NO'),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('..........'),$smarco,1,'L');

		$pdf->Ln(1);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Propietario:'),$smarco,0,'L');
		$pdf->Cell(40,$tam,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Inquilino:'),$smarco,0,'L');
		$pdf->Cell(40,$tam,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Residente:'),$smarco,0,'L');
		$pdf->Cell(40,$tam,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'L');
		$pdf->Ln(1);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(65,$tam,utf8_decode('Numero de documento de identidad (DNI, LE, CI):'),$smarco,0,'L');
		$pdf->Cell(115,$tam,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode(''),$smarco,1,'L');
		$pdf->Ln(1);

		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('OBSERVACIONES:'),$smarco,1,'L');
		$pdf->SetFont('Arial','',10);

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(180,$tam+2,utf8_decode('.....................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(180,$tam+2,utf8_decode('.....................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');

		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(180,$tam+2,utf8_decode('.....................................................................................................................................................................................'),$smarco,0,'L');
		$pdf->Cell(0,$tam+2,utf8_decode(''),$smarco,1,'L');

		$pdf->SetFont('Arial','',7);

		$pdf->Ln(5);

		$pdf->Cell(60,$tam+12,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(5,$tam+12,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(60,$tam+12,utf8_decode(''),$marco,0,'L');
		$pdf->Cell(5,$tam+12,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(60,$tam+12,utf8_decode(''),$marco,1,'L');

		$pdf->Cell(60,$tam+2,utf8_decode('FIRMA DEL USUARIO (*)'),$smarco,0,'C');
		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(60,$tam+2,utf8_decode('INSPECTOR/OPERARIO/SUPERVISOR'),$smarco,0,'C');
		$pdf->Cell(5,$tam+2,utf8_decode(''),$smarco,0,'C');
		$pdf->Cell(60,$tam+2,utf8_decode('SERVICIO TECNICO'),$smarco,1,'C');

		$pdf->Cell(60,$tam,utf8_decode('FECHA:'),$smarco,0,'L');
		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(60,$tam,utf8_decode('HORA INICIO:'),$smarco,0,'L');
		$pdf->Cell(5,$tam,utf8_decode(''),$smarco,0,'L');
		$pdf->Cell(60,$tam,utf8_decode('HORA FINAL:'),$smarco,1,'L');

		$pdf->Ln(5);
		$pdf->Cell(0,$tam,utf8_decode('*   OBSERVACION: L firma no implica acuerdo con el contenido del acta.'),$smarco,1,'L');

		$pdf->Ln(30);










		$pdf->Output();

        exit;
    }
}
