<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class FormatoSolicitudController extends Controller
{
    public function actMostrar($idSol=null)
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
		$pdf->text(55,18,utf8_decode('FORMATO 2'));
		$pdf->text(20,25,utf8_decode('EMUSAP S.A.C'));
		$pdf->text(20,32,utf8_decode('SOLICITUD DE RECLAMO'));

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
		$pdf->rect(10,35,190,3.4);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(30,$tam,utf8_decode('Cliente'),$smarco,0,'L');
		$pdf->Cell(80,$tam,utf8_decode('PALOMINO RIOS ALEJANDRINO'),$smarco,0,'L');
		$pdf->Cell(10,$tam,utf8_decode('D.N.I'),$smarco,0,'L');
		$pdf->Cell(30,$tam,utf8_decode('23435465'),$smarco,0,'L');
		$pdf->Cell(10,$tam,utf8_decode('R.U.C'),$smarco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('23435465111'),$smarco,1,'L');
		// --
	$pdf->rect(5,38.4,190,6.8);
		$pdf->Cell(30,$tam,utf8_decode('Direccion'),$marco,0,'L');
		$pdf->Cell(100,$tam,utf8_decode('AV NUÑEZ #127'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('Telefono: 965852565'),$marco,1,'L');

		$pdf->Cell(30,$tam,utf8_decode('Urb:'),$marco,0,'L');
		$pdf->Cell(50,$tam,utf8_decode('CASCO URBANO'),$marco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Provincia:'),$marco,0,'L');
		$pdf->Cell(35,$tam,utf8_decode('ABANCAY'),$marco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Distrito:'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('ABANCAY'),$marco,1,'L');
		// representante
	$pdf->rect(5,45.2,190,14);
		$pdf->Cell(30,$tam,utf8_decode('Representante:'),$marco,0,'L');
		$pdf->Cell(80,$tam,utf8_decode('ERICA RIOS LLAMOZA'),$marco,0,'L');
		$pdf->Cell(10,$tam,utf8_decode('D.N.I'),$marco,0,'L');
		$pdf->Cell(30,$tam,utf8_decode('45255852'),$marco,0,'L');
		$pdf->Cell(10,$tam,utf8_decode('Medidor'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('FA20125852'),$marco,1,'L');

		$pdf->Cell(30,$tam,utf8_decode('Direccion Notif 1:'),$marco,0,'L');
		$pdf->Cell(70,$tam,utf8_decode('PROL. NUÑEZ N 123'),$marco,0,'L');
		$pdf->Cell(30,$tam,utf8_decode('Direccion Notif 2:'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('-'),$marco,1,'L');

		$pdf->Cell(30,$tam,utf8_decode('Codigo Postal:'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('-'),$marco,1,'L');

		$pdf->Cell(30,$tam,utf8_decode('Telefono / Celular:'),$marco,0,'L');
		$pdf->Cell(70,$tam,utf8_decode('985658258'),$marco,0,'L');
		$pdf->Cell(30,$tam,utf8_decode('Correo Elect.:'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('kev.chu@gmail.com'),$marco,1,'L');
		// reclamo
	$pdf->rect(5,59.2,190,3.4);
		$pdf->Cell(30,$tam,utf8_decode('TIPO DE RECLAMO'),$marco,0,'L');
		$pdf->Cell(10,$tam,utf8_decode('Codigo:'),$marco,0,'L');
		$pdf->Cell(15,$tam,utf8_decode('4006'),$marco,0,'L');
		$pdf->Cell(20,$tam,utf8_decode('Descripcion:'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('RECLAMO POR CONSUMO ELEVADO10'),$marco,1,'L');
		// --
	$pdf->rect(5,62.6,190,7);
		$pdf->Cell(5,$tam,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(40,$tam,utf8_decode('FACTURAS RECLAMADAS'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('Nª Serie'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('Nª Recibo'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('Fecha Emision'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('Importe S/.'),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode('-'),$marco,1,'L');

		$pdf->Cell(5,$tam,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(40,$tam,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('1'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('3118245'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('01/09/2023'),$marco,0,'C');
		$pdf->Cell(25,$tam,utf8_decode('48.10'),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode('-'),$marco,1,'L');
		// --
	$pdf->rect(5,69.6,190,15.5);
		$pdf->Cell(5,$tam,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(40,$tam,utf8_decode('FUNDAMENTO DEL RECLAMO'),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode('-'),$marco,1,'L');

		$pdf->Cell(0,$tam+8,utf8_decode('-'),$marco,1,'L');
		$pdf->text(20,80,utf8_decode('Por incremento de facturacion-------------'));
		// --
	$pdf->rect(5,85.1,190,10.2);
		$pdf->Cell(5,$tam,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(50,$tam,utf8_decode('LA EPS ENTREGA'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('RELACION DE PRUEBAS QUE SE PRESENTAN ADJUNTAS:'),$marco,1,'L');

		$pdf->Cell(5,$tam,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(50,$tam,utf8_decode('CARTILLA INFORMATIVA'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('-----'),$marco,1,'L');

		$pdf->Cell(5,$tam,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(10,$tam,utf8_decode('SI'),$marco,0,'R');
		$pdf->Cell(5,$tam,utf8_decode('-'),$marco,0,'L');
		$pdf->Cell(10,$tam,utf8_decode('NO'),$marco,0,'R');
		$pdf->Cell(5,$tam,utf8_decode('-'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('-'),$marco,1,'L');

		$pdf->Ln(2);

		$pdf->Cell(5,$tam+5,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(40,$tam+5,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(100,$tam+5,utf8_decode('-'),$marco,0,'R');
		$pdf->Cell(10,$tam+5,utf8_decode('-'),$marco,0,'L');
		$pdf->Cell(0,$tam+5,utf8_decode('-'),$marco,1,'L');
		$pdf->text(20,100,utf8_decode('DECLARACION DEL'));
		$pdf->text(20,105,utf8_decode('RECLAMANTE'));
		$pdf->text(60,100,utf8_decode('Aplicable a reclamos por consumo medido:, solicito la realizacion de prueba de'));
		$pdf->text(60,105,utf8_decode('constrastacion y acepto asumir su costo.'));
		$pdf->text(160,100,utf8_decode('SI'));
		$pdf->text(160,105,utf8_decode('NO'));
		$pdf->text(165,100,utf8_decode('..................'));
		$pdf->text(165,105,utf8_decode('..................'));

		$pdf->Ln(2);

		$pdf->Cell(5,$tam,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(110,$tam,utf8_decode('INFORMACION A SER COMPLETADA POR LA EPS:'),$marco,0,'L');
		$pdf->Cell(0,$tam,utf8_decode('-'),$marco,1,'C');

		$pdf->Cell(90,$tam,utf8_decode('INSPECCION INTERNA Y EXTERNA'),$marco,0,'l');
		$pdf->Cell(20,$tam,utf8_decode('FECHA'),$marco,0,'R');
		$pdf->Cell(20,$tam,utf8_decode('30/11/22'),$marco,0,'C');
		$pdf->Cell(40,$tam,utf8_decode('HORA (RANGO DE 2 HORAS)'),$marco,0,'R');
		$pdf->Cell(0,$tam,utf8_decode('11.30 A 12.30'),$marco,1,'C');

		$pdf->Cell(90,$tam,utf8_decode('CITACION A REUION'),$marco,0,'l');
		$pdf->Cell(20,$tam,utf8_decode('FECHA'),$marco,0,'R');
		$pdf->Cell(20,$tam,utf8_decode('30/11/22'),$marco,0,'C');
		$pdf->Cell(40,$tam,utf8_decode('HORA'),$marco,0,'R');
		$pdf->Cell(0,$tam,utf8_decode('11.30 A 12.30'),$marco,1,'C');

		$pdf->Cell(90,$tam,utf8_decode('FECHA MAXIMA DE NOTIFICACION DE LA RESOLUCION'),$marco,0,'l');
		$pdf->Cell(20,$tam,utf8_decode('FECHA'),$marco,0,'R');
		$pdf->Cell(20,$tam,utf8_decode('30/11/22'),$marco,0,'C');
		$pdf->Cell(0,$tam,utf8_decode('-'),$marco,1,'C');

		// $pdf->text(10,140,utf8_decode('_________________________________________'));
		// $pdf->text(25,145,utf8_decode('Firma del Usuario'));
		// $pdf->text(10,145,utf8_decode('Firma del Usuario'));

		$pdf->Ln(9);

		$pdf->Cell(50,$tam,utf8_decode('________________________________________'),$marco,0,'l');
		$pdf->Cell(0,$tam,utf8_decode('-'),$marco,1,'C');
		
		$pdf->Cell(50,$tam,utf8_decode('Firma del Usuario'),$marco,0,'C');
		$pdf->Cell(80,$tam,utf8_decode('-'),$marco,0,'C');
		$pdf->Cell(30,$tam,utf8_decode('Fecha:'),$marco,0,'R');
		$pdf->Cell(0,$tam,utf8_decode('14/10/22'),$marco,1,'L');

		$pdf->Cell(50,$tam,utf8_decode('PALOMINO RIOS, ALEJANDRINO'),$marco,0,'C');
		$pdf->Cell(80,$tam,utf8_decode('Huella Digital'),$marco,0,'C');
		$pdf->Cell(30,$tam,utf8_decode('Atendido por:'),$marco,0,'R');
		$pdf->Cell(0,$tam,utf8_decode('JCRUZ'),$marco,1,'L');

		$pdf->Output();

        exit;
    }
}
