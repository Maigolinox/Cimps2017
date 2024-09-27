<!----****************************************************informacion(centro)*****************************************************************------->
<!-- Estilos de la tabla-->
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<!--  fin de los estilos de la tabla -->

<script>
	function updateGaffete(cb)
	{
		url = "<?php echo site_url("admin/ajax_update_gaffete/")?>" + "/" + cb.value + "/"+ (cb.checked ? "1" : "0");  
		$.get( url, function( data ) {
				color = cb.checked ? "rgba(0, 255, 0, 0.33)" : "rgba(255, 0, 0, 0.33)";
				cb.parentNode.style.backgroundColor = color;
			});
	}

	function sendEmailById($id_user)
	{
		$.ajax({
           		type: "POST",
          		url: "<?php echo site_url("admin/mandarEmail")?>",
           		data : {id_user : $id_user},
           		success:function(result) {
             			alert('Correo enviado exitosamente.');
           		},
           		failure:function(result){
             			alert('Error al enviar correo.');
           		}
	     	});
	}
	function updateOrderPayment(cb)
	{
		url = "<?php echo site_url("admin/ajax_update_order/")?>" + "/" + cb.value + "/"+ (cb.checked ? "1" : "0");  
		$.get( url, function( data ) {
				color = cb.checked ? "rgba(0, 255, 0, 0.33)" : "rgba(255, 0, 0, 0.33)";
				cb.parentNode.style.backgroundColor = color;
			});
	}

	function updateTotalDescuento(moneda, id)
	{
		tecla = event.keyCode;
		if (tecla != 13)
			return;
		
		if (moneda == 0)
		{
			sTotal = "tp_";
			sInput = "discount_pesos_";
			sP = "tdp_";
			iTotal = parseFloat(($("#"+sTotal+id).html()).substring(1));
		}
		else
		{
			sTotal = "te_"
			sInput = "discount_euros_";
			sP = "tde_";
			iTotal = parseFloat($("#"+sTotal+id).html());
		}
		
		sValor = $("#"+sInput+id).val();
		fValor = parseFloat(sValor);
		if (isNaN(fValor))
		{
			fValor = parseFloat(sValor.substring(1));
			if (isNaN(fValor))
				return;
		}

		nuevoTotal  =  iTotal - fValor;

		if (moneda == 0)
			$("#"+sP+id).html("$"+nuevoTotal);
		else
			$("#"+sP+id).html(nuevoTotal+"€");
		$("#"+sP+id).css('background-color', 'yellow');
		$("#"+sP+id).css('opacity', '0.6');

		url = "<?php echo site_url("admin/ajax_update_discount/")?>" + "/" + id + "/" + moneda + "/" + fValor;  
		$.get( url, function( data ) {
				$("#"+sP+id).css('background-color', 'transparent');
				$("#"+sP+id).css('opacity', '1');
			});
		

	}

	function verPago(user_id)
	{
		url = "<?php echo site_url("admin/ajax_get_order/")?>" + "/" + user_id;
		$.get( url, function( data ) {
				$("#div_ajax").html(data);
				parentOffset = $("#div_ajax").parent().offset();
				center_x = ($(window).width() - $("#div_ajax").width())/2  -  parentOffset.left;
				center_y = $(window).height()/3 - $("#div_ajax").height()/2  -  parentOffset.top; 
				$("#div_ajax").css({ "margin-left": center_x + "px",   "margin-top": center_y + "px" });
				$("#div_ajax").css({ "visibility": "visible"});
				$("#div_negro").css({ "visibility": "visible"});
			});
	}

	function ocultarPago()
	{
		$("#div_ajax").html("");
		$("#div_ajax").css({ "visibility": "hidden" });
		$("#div_negro").css({ "visibility": "hidden"});
	}

</script>

<!----****************************************************crud(centro)*****************************************************************------->
			
			<!--      Ventanas emergentes   -->
			<div id="div_negro" style="visibility: hidden; position: fixed;
									margin-top: -1080px; margin-left: -1920px;
									width: 3840px; height: 2060px;
									background-color: rgba(0, 0, 0, 0.66); z-index: 99;"></div>
									
			<div id="div_ajax" style="background-color: white; border-style: solid; border-width: medium; border-color:lightblue;
									border-radius: 10px;
									visibility: hidden; position: fixed; z-index: 100"></div>					   
								   
			<?php echo $output; ?> 
			
			
			
								   
								   
			
			<!--          JAVASCRIPT       -->
			
			<script type="text/javascript">
			   
			  
			   
			</script>
