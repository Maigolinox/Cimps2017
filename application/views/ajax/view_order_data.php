<table style="width:100%;">
	<tr>
		<td colspan="2"><strong><?php echo $user->tittle." ".$user->name?></strong></td>
	</tr>
	<tr>
		<td>Payment Type</td>
		<td><?php echo $order->type_payment?></td>
	</tr>
	<tr>
		<td>Bank</td>
		<td><?php echo $order->bank?></td>
	</tr>
	<tr>
		<td>Reference</td>
		<td><?php echo $order->reference?></td>
	</tr>
	<tr>
		<td>Date</td>
		<td><?php echo $order->date?></td>
	</tr>
	<tr>
		<td>Organization</td>
		<td><?php echo $order->organization?></td>
	</tr>
	<tr>
		<td>Payment Ticket</td>
		<td><?php if ($order->image == null  ||  $order->image == "")
						echo "- - -";
					else 
					{
						$link = base_url()."assets/payments/".$order->image;
						echo "<a href='{$link}' target='_blank')>Image</a>";
					}
			?></td>
	</tr>
	<tr>
		<td></td>
		<td><a href='javascript:void(0);' onClick="ocultarPago();">CERRAR</a></td>
	</tr>
</table>