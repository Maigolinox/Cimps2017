<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include('pdf/mpdf.php');

class PDF
{
	public function generatePDF($html){
		$mpdf=new mPDF('', 'Legal');
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->AddPage('L');
		$stylesheet = file_get_contents('http://cimps.cimat.mx/registration_system/assets/css/tabla.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Program_CIMPS_2014.pdf', 'I');
		exit;
	}
	
	public function generatePDF2($html){
		$mpdf=new mPDF('', 'Legal');
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->AddPage('L');
		$mpdf->WriteHTML($html);
		$mpdf->Output('constancia.pdf', 'I');
		exit;
	}
}