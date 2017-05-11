<font face="Arial,Verdana,Tahoma">
Dear <?php echo $autor->tittle." ".$autor->name ?>,<br/>

Thank you for registering on CIMPS 2016!<br/><br/>

Your account login data is:<br/>
<strong>User:</strong>&nbsp;<?php echo $autor->username ?><br/>
<strong>Pasword:</strong>&nbsp;<?php echo $password ?><br/><br/>

<strong>SUMMARY:</strong><br/><br/>
Registered as:  <strong><?php echo $group ?></strong><br/>
Choosen concepts:<br/>
<?php echo "<table style='font-family:arial,verdana,tahoma;font-size:smaller;'>";
	foreach ($orden as $key) {
		echo "<tr><td>&nbsp;&nbsp;&nbsp;-&nbsp;{$key->name}:&nbsp;</td>
			<td>"."$"."{$key->total}</td>
			<td>{$key->euro}€</td>
			</tr>";
	}
	echo "</table>";
?>

<br/>
<strong>Total:</strong><br/>
$ <?php echo $total ?> Mexican Pesos, or <br/>
<euro> <?php echo $total_euros ?> € Euros<br/><br/>

<strong>Payment methods:</strong><br/><br/>
Via PayPal:<br/>
<!-- PayPal button to pay in mexican pesos -->  
<div>
<strong><?php echo lang("cimps_paypal_mexican"); ?></strong><br/>
<form action='https://www.paypal.com/cgi-bin/webscr' method='post' name='form'>
  <input type='hidden' name='business' value='admeventos@cimat.mx'>
  <input type='hidden' name='cmd' value='_xclick'> 
  <input type='hidden' name='item_name' value='Pago para CIMPS 2016'>
  <input type='hidden' name='item_number' value='1'>
  <input type='hidden' name='amount' value='<?php echo $total ?>'>
  <input type='hidden' name='no_shipping' value='1'>
  <input type='hidden' name='currency_code' value='MXN'>
  <input type='hidden' name='cancel_return' value='http://cancel.com'>
  <input type='hidden' name='return' value='http://return.com/'>
  <input type="image" src="https://paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="submit">
</form>
</div>
<br/><br/>
<!-- PayPal button to pay in euros -->
<div>
<strong><?php echo lang("cimps_paypal_euros"); ?></strong><br/>
<form action='https://www.paypal.com/cgi-bin/webscr' method='post' name='form'>
  <input type='hidden' name='business' value='admeventos@cimat.mx'>
  <input type='hidden' name='cmd' value='_xclick'> 
  <input type='hidden' name='item_name' value='Pay to CIMPS 2016'>
  <input type='hidden' name='item_number' value='1'>
  <input type='hidden' name='amount' value='<?php echo $total_euros ?>'>
  <input type='hidden' name='no_shipping' value='1'>
  <input type='hidden' name='currency_code' value='EUR'>
  <input type='hidden' name='cancel_return' value='http://cancel.com'>
  <input type='hidden' name='return' value='http://return.com/'>
  <input type="image" src="https://paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="submit">
</form>
</div><br/><br/>
Bank deposit or electronic transfer:<br/><br/>

Payment must be through a bank deposit as follows:<br/><br/>

<strong>Receiver Bank information:</strong><br/>
Account Name: CENTRO DE INVESTIGACION EN MATEMATICAS, A.C.<br/>
Bank Name: HSBC<br/>
Bank Account: 215003142-6<br/>
CLABE: 021210021500314264<br/>
ABA: 026003052<br/>
SWIFT: BIMEMXMM<br/>
Sucursal: 866<br/>
Plaza: 21<br/><br/>

<strong>Bank Address:</strong><br/>
Address: Víctor Cervera Pacheco No. 14, Mz 10, L4<br/>
City: Guanajuato<br/>
State/ Province: Guanajuato<br/>
Post/Zip code: 36250<br/>
Country: México<br/><br/>

<strong>Institution Address:</strong><br/>
Jalisco S/N, Mineral de Valenciana<br/>
City: Guanajuato<br/>
State/ Province: Guanajuato<br/>
Post/Zip code: 36240<br/>
Country: México<br/>
Telephone: +52 473 7350800<br/><br/>

Scanned payment receipt must be sent to <a href="http://cimps.cimat.mx/registration_system/index.php/payment">http://cimps.cimat.mx/registration_system/index.php/payment</a><br/>
by clicking the Add Payment button indicating full name of the participant.<br/>
If an invoice is required, fiscal data must be sent for processing.<br/><br/>

Original billings will be sent to the registered e-mail address or delivered at CIMPS Conference (October 12-14, 2016).<br/>
</font>
