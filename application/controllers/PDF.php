<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include('pdf/mpdf.php');

class PDF
{
	public function generatePDF($html){
		$mpdf=new mPDF();
		$stylesheet = file_get_contents('http://cimps.cimat.mx/registration_system/assets/css/estilos.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
	}
}