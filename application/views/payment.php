 <!--Menu-->
 <ul class="nav nav-justified">
    <li>
        <a  href="http://cimps.cimat.mx/registro/index.php/user/" >
            <img  src="<?php echo base_url() ?>assets/img/logo_home.png" style="width:30px;height:30px; margin: -30px -30px -30px -30px;">
        </a>
    </li>
    <!--<li><a href="http://cimps.cimat.mx/registration_system/index.php/user/"><?php echo lang("cimps_MenuHome"); ?></a></li>-->
    <li><a href="<?php echo site_url('user/information'.$url_crud_id) ?>"><?php echo lang("cimps_MenuUpdate"); ?></a></li>

    <li class="active"><a href="<?php if (isset($admin) && $admin)
        echo site_url('payment/index'.$url_crud_id);
        else 
            echo site_url('payment'); ?>"><?php echo lang("cimps_MenuAdd"); ?></a></li>

        <!--REGISTRO DE CURSO-->
            <?php if(isset($user) && !empty($user)){ ?>
                <?php if (isset($admin)){ ?>
                <?php } else { ?> 
                <?php if($accepted) { ?>
                <li>
                <a href="http://sistemas.ita.mx/fieat/registro/?id=<?php echo $user->id ?>&title=<?php echo $user->tittle ?>&name=<?php echo $user->name ?>&university=<?php echo $user->afiliation_name ?>&email=<?php echo $user->email ?>"><?php echo lang("cimps_add_course");?></a>
                 </li>
            <?php } } } ?>
       <!--/REGISTRO DE CURSO-->

      


        <li><a href="http://cimps.cimat.mx/contact-information/" target="_blank"><?php echo lang("cimps_MenuContact"); ?>
            
        </a></li>
        <!--<li><a href="<?php echo site_url('auth/logout') ?>"><?php echo lang("cimps_MenuLogout"); ?></a></li>-->
    </ul>
    <!--Menu-->

<div style="margin:20px;"></div>
<h2 style="text-align: center"><?php echo lang("cimps_PagPayment"); ?></h2>
<div class="row">
   <div class="col-md-8">
      
      <!-- SECCION TABLA DE PAGO -->
      <?php echo (!empty($suc)) ? '<div class="alert alert-success">'.$suc.'</div>' : ''?>
      <div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF;">
         <div style="margin-left: -25px; margin-top: -25px;">
            <img style=" width:50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_paym_state.png" />   
            <div style="margin: -35px 20px 0px 50px;">
               <label >
                  <h3><?php echo lang("cimps_account_statement"); ?></h3>
               </label>
            </div>        
            <div style="margin: 5px 20px 20px 70px;">
            
               <table class="table table-condensed">
                  <tr>
                     <td style="padding-right:3em"><b><?php echo lang("cimps_PagRegistro"); ?></b></td>
                     <td style="padding-right:3em"><b><?php echo lang("cimps_PagAmountPesos"); ?></b></td>
                     <td><b><?php echo lang("cimps_PagAmountEuros"); ?></b></td>
                  <tr>
                     <?php $total = 0; $totalEuro = 0; ?>
                     <?php foreach($costs as $cost): ?>
                     <?php $total += $cost->total; $totalEuro += $cost->euro;?>
                  <tr>
                     <td><?php echo $cost->name ?></td>
                     <td>$<span class="cost"><?php echo $cost->total ?></span></td>
                     <td><span class="cost"><?php echo $cost->euro ?></span>€</td>
                  </tr>
                  <?php endforeach; ?>
                  <tr>
                     <td><b>Total</b></td>
                     <td><b>$<span class="cost"><?php echo $total ?></span></b></td>
                     <td><b><span class="cost"><?php echo $totalEuro  ?></span>€</b></td>
                  </tr>
                  <?php if ($discounts->discount != 0  ||  $discounts->discount_euros != 0) :?>
                  <tr>
                     <td><b>Discount</b></td>
                     <td><b>$<span class="cost"><?php echo $discounts->discount ?></span></b></td>
                     <td><b><span class="cost"><?php echo $discounts->discount_euros ?></span>€</b></td>
                  </tr>
                  <tr class="success">
                     <td><b>Grand Total</b></td>
                     <td><b>$<span class="cost"><?php echo $total - $discounts->discount ?></span></b></td>
                     <td><b><span class="cost"><?php echo $totalEuro - $discounts->discount_euros ?></span>€</b></td>
                  </tr>
                  <?php endif ?>
                  </tr>
               </table>
            </div>
         </div>
      </div>
      <!-- /SECCION TABLA DE PAGO -->
      

      <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
      <?php echo (!empty($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : ''?>
      

      <!-- SECCION DE PAGOS CON PAYPAL -->  
      <div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF; margin-top: 30px;">
         <div style="margin-left: -25px; margin-top: -25px;">
            <!--logo-->
            <img style=" width: 50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_paym_payp.png" />
            <div style="margin: -35px 20px 0px 50px;">
               <label>
                  <h3><?php echo lang("cimps_paypal"); ?></h3>
               </label>
               <label><?php echo lang("cimps_paypal_sed"); ?></label>
               </br></br>
            </div>

         </div>
         <div class='row' style="margin-left: 35px;">
            <!-- Buton de PayPal para pagos en pesos mexicanos -->
            <div class="col-md-6">
               <strong><?php echo lang("cimps_paypal_mexican"); ?></strong>
               <form action='https://www.paypal.com/cgi-bin/webscr' target="_blank" method='post' name='form' style="margin-right: 20px;">
                  <input type='hidden' name='business' value='admeventos@cimat.mx'>
                  <input type='hidden' name='cmd' value='_xclick'> 
                  <input type='hidden' name='item_name' value='Pago para CIMPS 2017'>
                  <input type='hidden' name='item_number' value='1'>
                  <input type='hidden' name='amount' value='<?php echo $total ?>'>
                  <input type='hidden' name='no_shipping' value='1'>
                  <input type='hidden' name='currency_code' value='MXN'>
                  <input type='hidden' name='cancel_return' value='http://cancel.com'>
                  <input type='hidden' name='return' value='http://return.com/'>
                  <input type="image"   src="https://paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="submit">
               </form>
            </div>
            <!-- Buton de PayPal para pagos en euros -->
            <div class="col-md-6 pull-right">
               <strong><?php echo lang("cimps_paypal_euros"); ?></strong>
               <form action='https://www.paypal.com/cgi-bin/webscr' target="_blank" method='post' name='form' style="">
                  <input type='hidden' name='business' value='admeventos@cimat.mx'>
                  <input type='hidden' name='cmd' value='_xclick'> 
                  <input type='hidden' name='item_name' value='Pay to CIMPS 2017'>
                  <input type='hidden' name='item_number' value='1'>
                  <input type='hidden' name='amount' value='<?php echo $totalEuro ?>'>
                  <input type='hidden' name='no_shipping' value='1'>
                  <input type='hidden' name='currency_code' value='EUR'>
                  <input type='hidden' name='cancel_return' value='http://cancel.com'>
                  <input type='hidden' name='return' value='http://return.com/'>
                  <input type="image"   src="https://paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="submit">
               </form>
            </div>
         </div>
         <br>
      </div>
      <!-- /SECCION DE PAGOS CON PAYPAL -->


      <!-- SECCION DE FORMULARIO DE PAGO -->  
      <div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF; margin-top: 30px;">
         <div style="margin-left: -25px; margin-top: -25px;">
            <!--logo-->
            <img style=" width: 50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_paym_depo.png" />
            <div  style="margin: -35px 20px 0px 50px;">
               <label>
                  <h3><?php echo lang("cimps_deposit_detail"); ?></h3>
               </label>
            </div>
            
         </div>
         <div style="margin: 5px 5px 20px 50px;">
            <form role="form" method="post" action="<?php echo site_url('payment/add'.$url_crud_id) ?>" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo lang("cimps_PagWaysPayment"); ?></label>
                  <div>
                        <?php echo form_dropdown('payment_type', $payment_type, set_value('paypal'), 'class="round" id="payme"') ?>
                  </div>
               </div>
               <div id="comprobante" style="display: none;">
                <h5><?php echo lang("cimps_PagDigitalize");?></h5>
                     <div class="form-group">
                        <label for="inputName"><?php echo lang("cimps_PagDate"); ?></label>
                        <div>
                           <input id="date" value="<?php echo set_value('date', $order->date) ?>" name="date" type="text" class="round" placeholder="Date" style="width: 250px;">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputName"><?php echo lang("cimps_PagBank"); ?></label>
                        <div>
                           <input name="bank" value="<?php echo set_value('bank', $order->bank) ?>" type="text" class="round" placeholder="<?php echo lang("cimps_PagBank"); ?>" style="width: 450px;">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputName"><?php echo lang("cimps_PagReference"); ?></label>
                        <div>
                           <input type="text" name="reference" value="<?php echo set_value('reference', $order->reference) ?>" class="round" placeholder="Reference" style="width: 450px;">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputName"><?php echo lang("cimps_PagTax"); ?></label>
                        <div>
                           <input name="tax_number" value="<?php echo set_value('reference', $order->tax_number) ?>" type="text" class="round" placeholder="tax" style="width: 450px;">
                        </div>
                     </div>
                     </div>

                     <div class="form-group">
                        <div><?php if(!empty($order->image)){ ?>
                           <a href="<?php echo base_url()."assets/payments/".$order->image ?>"><?php echo base_url()."assets/payments/".$order->image ?></a>
                           <?php } ?>
                        </div>
                        <label for="exampleInputFile"><?php echo lang("cimps_PagProofofPayment"); ?></label>
                        <input name="proof_payment" type="file" id="exampleInputFile">
                     </div>
               <div>
                  <button style="margin-right: 40px;" class="btn btn-primary pull-right" type="submit"><?php echo (empty($order->payment_type)) ? lang("cimps_PagSubmit") : 'Update Payment'; ?>
                     </button>
                     <br></br>
               </div>

            
         </div>
      </div>
      <!-- /SECCION DE FORMULARIO DE PAGO -->

      <!-- SECCION DE INFORMACION PARA FACTURA -->
      <div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF; margin-top: 30px;">
         <div style="margin-left: -25px; margin-top: -25px;">
            <!--logo-->
            <img style=" width: 50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_paym_depo.png" />
         </div>
            <div style="margin: 5px 5px 20px 35px;">
            <label><?php echo lang("cimps_factura"); ?></label><br>
            <label>conferencecimps@cimat.mx</label></br>
            <label>jmejia@cimat.mx</label>

             <!--  <div class="form-group">
                  <label for="inputName"><?php echo lang("cimps_PagData_advice"); ?></label>
                  <div>
                  <select name="tax" id="tax" class="round">
                     <option value="1"><?php echo lang("cimps_PagResponseY"); ?></option>
                     <option value="0"><?php echo lang("cimps_PagResponseN"); ?></option>
                  </select>
                  </div>                  
               </div>
               <div id="extra" <?php echo (empty($order->organization))? 'style="display:none;"' : 'style=""' ?>>
                  <h6><?php echo lang("cimps_PagIfResponseN"); ?></h6>
                  <div class="form-group">
                     <label for="organization"><?php echo lang("cimps_PagOrganization"); ?></label>
                     <div>
                        <input name="organization" type="text" value="<?php echo set_value('organization', $order->organization) ?>" class="round" placeholder="organization" style="width: 450px;">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="address"><?php echo lang("cimps_PagAddres"); ?></label>
                     <div>
                        <input name="adress" type="text" value="<?php echo set_value('adress', $order->adress) ?>" class="round" placeholder="address" style="width: 450px;">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="locality"><?php echo lang("cimps_PagLocality"); ?></label>
                     <div>
                        <input name="locality" type="text" value="<?php echo set_value('locality', $order->locality) ?>" class="round" placeholder="locality" style="width: 450px;">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="postal_code"><?php echo lang("cimps_PagPostalCode"); ?></label>
                     <div>
                        <input name="postal_code" type="text" value="<?php echo set_value('postal_code', $order->postal_code) ?>" class="round" placeholder="postal_code" style="width: 450px;">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="country"><?php echo lang("cimps_PagCountry"); ?></label>
                     <div>
                        <input name="country" type="text" value="<?php echo set_value('country', $order->country) ?>" class="round" placeholder="country" style="width: 450px;">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="phone_number"><?php echo lang("cimps_PagPhoneNumber"); ?></label>
                     <div>
                        <input name="phone_number" type="text" value="<?php echo set_value('phone_number', $order->phone_number) ?>" class="round" placeholder="phone_number" style="width: 450px;">
                     </div>
                  </div>
               </div>-->
      </div>
      </div>
      <!-- /SECCION DE INFORMACION PARA FACTURA -->

      </form>

   </div>
   <div class="col-md-4" style="margin-top: -30px;">
      <div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF; margin-top: 30px;">
         <div style="margin-left: -25px; margin-top: -25px;">
            <!--logo-->
            <img style=" width:50px; height: 50px;" src="<?php echo base_url() ?>assets/img/logo_paym_metopay.png" />
            <div style="margin-top: -25px; margin-left: 40px;">
               <label>
                  <h3><?php echo lang("cimps_Payment_Method"); ?></h3>
               </label>
            </div>
          
         </div>
         <div style="margin: -10px 5px 5px 5px;">
            <pre><?php echo lang("cimps_Barralateralpago"); ?></pre>
         </div>
      </div>
</div>
<script>
   $(function() {
   	$( "#date" ).datepicker({
   		changeMonth: true,
   		changeYear: true,
   		yearRange: "2017:2017"
   	});
   
   	$('#tax').on('change', function() {
   	  /*if( this.value =="1" ){
   		extra
   	}*/
   	$("#extra").toggle();


   });

      $('#payme').on('change', function(){
        tipopago();
      });


function tipopago() {
     tipo = $("#payme").val();
         if(tipo == 'paypal'){
            $('#comprobante').hide();
         }else if(tipo == 'deposit'){
            $('#comprobante').toggle();
         }else if(tipo == 'bank transfer'){
            $('#comprobante').toggle();
         }
}

   });
</script>
</div>