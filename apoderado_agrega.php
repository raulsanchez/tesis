<?php
session_start();
require_once 'clases/conectar.class.php';
if(!isset($_SESSION['id_admin'])):
	echo "<script type=''>";
		echo "window.location='entrar.php?url=";
		echo $_SERVER['REQUEST_URI']."'";
	echo "</script>";
endif;
$query = "SELECT al_nombre,al_apaterno,al_amaterno FROM  `alumno`";
$result = mysql_query($query,Conectar::conecta());

?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<script>
			function Autocomplete_apo(param){
				$("#rut_status2").load("ajax/rut_apoderado.php", {sugerencia: param});
			};
 		</script>


 		</head>
	<!-- FIN HEAD -->
	<body>
	<!-- HEADER -->
		<?php include 'template/header.php';?>
	<!-- FIN HEADER -->
	<!-- MENU  -->
		<?php include 'template/nav.php'; ?>
	<!-- FIN MENU -->
	<div id="submenu">
		<div class="submenu">
		<!-- 	<ul>
				<a href="alumno_agrega.php"><li><img src="images/add.png" alt="nuevo"> Nuevo</li></a>
				<a href=""><li><img src="images/pencil.png" alt=""> Editar</li></a>
				<a href=""><li><img src="images/delete.png" alt=""> Eliminar</li></a>
			</ul> -->
		</div>
	</div>
	<div id="contenido">
			<h2>Ingresando un Apoderado</h2>
			<form action="" method="POST" enctype="multipart/form-data">
				<input type='hidden' name="issubmit" value="1">
				<div id="wizard" class="swMain">
						<ul>
			  				<li>
			  					<a href="#step-1">
					                <label class="stepNumber">1</label>
					                <span class="stepDesc">
					                   Datos Apoderado<br />
					                   <small>Llene los campos</small>
					                </span>
			            		</a>
			        		</li>
			  				<li>
			  					<a href="#step-2">
					                <label class="stepNumber">2</label>
					                <span class="stepDesc">
					                   Configuración<br />
					                   <small>seleccione las opciones</small>
					                </span>
			             		</a>
			         		</li>
			  			</ul>


<!-- *******************************************  DATOS APODERADO  *********************************************** -->
		  			<div id="step-1">
		            <h2 class="StepTitle">Paso 1: Datos del apoderado</h2>
		            	<table cellspacing="3" cellpadding="3" align="center">
		          			<tr>
		                    	<td align="center" colspan="3">&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Rut Apoderado :</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_rut" name="ap_rut" value="" class="txtBox" onblur="Autocomplete_apo(this.value)" >
		                    	<div id="rut_status2"></div>
		                      </td>
		                    	<td align="left"><span id="msg_ap_rut"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Nombre :</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_nombre" name="ap_nombre" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_ap_nombre"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Apellido Paterno :</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_apaterno" name="ap_apaterno" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_ap_apaterno"></span>&nbsp;</td>
		          			</tr>
		               		<tr>
		                    	<td align="right">Apellido Materno :</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_amaterno" name="ap_amaterno" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_ap_amaterno"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Fecha Nacimiento :</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_fecha_nac" name="ap_fecha_nac"  class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_ap_fecha_nac"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Domicilio :</td>
		                    	<td align="left">
		                    	  	<textarea name="ap_direccion" id="ap_direccion" class="txtBox" rows="2"></textarea>
		                      </td>
		                    	<td align="left"><span id="msg_ap_direccion"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Comuna :</td>
			                    	<td align="left">
				                        <select id="ap_comuna" name="ap_comuna" class="txtBox">
					                        <option value="">-Seleccione-</option>
					                        <option value="Corral">Corral</option>
					                        <option value="Lanco">Lanco</option>
					                        <option value="Los Lagos">Los Lagos</option>
					                        <option value="Máfil">Máfil</option>
					                        <option value="Mariquina">Mariquina</option>
					                        <option value="Paillaco">Paillaco</option>
					                        <option value="Panguipulli">Panguipulli</option>
					                        <option value="Valdivia">Valdivia</option>
				                        </select>
			                      	</td>
		                    	<td align="left"><span id="msg_ap_comuna"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Correo :</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_correo" name="ap_correo" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_ap_correo"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Celular :</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_celular" name="ap_celular" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_ap_celular"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Otro Celular :</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_celular2" name="ap_celular2" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_ap_celular2"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Telefono :</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_telefono" name="ap_telefono" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_ap_telefono"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Telefono Trabajo:</td>
		                    	<td align="left">
		                    	  <input type="text" id="ap_telefono_t" name="ap_telefono_t" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_ap_telefono_t"></span>&nbsp;</td>
		          			</tr>
		  			   </table>
		        </div>
	<!--- ****************************** Configuracion ***************************************************  -->
		  			<div id="step-2">
		            <h2 class="StepTitle">Paso 2: Configuracion</h2>
		            <table cellspacing="3" cellpadding="3" align="center">
		          			<tr>
		                    	<td align="center" colspan="3">&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Alumno :</td>
		                    	<td align="left">
		                    	  <input type="text" name="alumno" id="alumno"  class="txtBox" list="alumno2">
		                    	  	<datalist id="alumno2">
										<?php
				       					while ($row=mysql_fetch_array($result)):
		       								echo '<option value="'.$row['0']." ".$row['1']." ".$row['2'].'">';
				        				endwhile;
			        					?>
									</datalist>
		                      </td>
		                    	<td align="left"><span id="msg_alumno"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Envio de correo</td>
		                    	<td align="left">
		                    		<input type="checkbox" name="correo" id="correo"> Deceo recibir correos electronicos
		                      </td>
		                    	<td align="left"><span id="msg_phone"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Envio de Mensaje de texto</td>
		                    	<td align="left">
		                    		<input type="checkbox" name="sms" id="sms"> Deceo recibir mensaje de texto
		                      </td>
		                    	<td align="left"><span id="msg_address"></span>&nbsp;</td>
		          			</tr>
		  			   </table>
		        	</div>
		  		</div>
			</form>
		<div class="clear"></div>
	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
	<script type="text/javascript">

    $(document).ready(function(){
    	// Smart Wizard
       $('#wizard').smartWizard({
        onLeaveStep:leaveAStepCallback,
        transitionEffect: 'slide',
        onFinish:onFinishCallback,
		hideButtonsOnDisabled:true,
        keyNavigation: false,
        labelNext:'Siguiente',
        labelPrevious:'Anterior',
        labelFinish:'Guardar'
      });
        function leaveAStepCallback(obj, context){
            return validateSteps(context.fromStep); // return false to stay on step and true to continue navigation
        }
        function onFinishCallback(objs, context){
            if(validateAllSteps()){
                $('form').submit();
            }
        }
		});
    function validateSteps(step){
      var isStepValid = true;
      // validate step 1
      if(step == 1){
        if(validateStep1() == false ){
          isStepValid = false;
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
        }
      }
      // validate step 2
      if(step == 2){
        if(validateStep2() == false ){
          isStepValid = false;
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
        }
      }
      return isStepValid;
    }


    function validateStep1(){
       var isValid = true;
       // Valida Rut
       var un = $('#ap_rut').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_ap_rut').html('Por favor ingrese el Rut del alumno').show();
       }else{
         $('#msg_ap_rut').html('').hide();
       }
       // Validate nombre
       var un = $('#ap_nombre').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_ap_nombre').html('Por favor ingrese el/los nombre/s').show();
       }else{
         $('#msg_ap_nombre').html('').hide();
       }
       var un = $('#ap_apaterno').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_ap_apaterno').html('Por favor ingrese apellido paterno').show();
       }else{
         $('#msg_ap_apaterno').html('').hide();
       }
       var un = $('#ap_amaterno').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_ap_amaterno').html('Por favor ingrese apellido materno').show();
       }else{
         $('#msg_ap_amaterno').html('').hide();
       }
       var un = $('#ap_fecha_nac').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_ap_fecha_nac').html('Por favor ingrese fecha de nacimiento').show();
       }else{
         $('#msg_ap_fecha_nac').html('').hide();
       }
       var un = $('#ap_direccion').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_ap_direccion').html('Por favor ingrese el domicilio').show();
       }else{
         $('#msg_ap_direccion').html('').hide();
       }
       var un = $('#ap_comuna').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_ap_comuna').html('Por favor seleccione la comuna').show();
       }else{
         $('#msg_ap_comuna').html('').hide();
       }

       return isValid;
    }

    function validateStep2(){
      var isValid = true;
      // //validate email  email
      // var email = $('#email').val();
      //  if(email && email.length > 0){
      //    if(!isValidEmailAddress(email)){
      //      isValid = false;
      //      $('#msg_email').html('Email is invalid').show();
      //    }else{
      //     $('#msg_email').html('').hide();
      //    }
      //  }else{
      //    isValid = false;
      //    $('#msg_email').html('Please enter email').show();
      //  }
      return isValid;
    }

    function validateAllSteps(){
       var isStepValid = true;

       if(validateStep1() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});
       }else{
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
       }
       if(validateStep2() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});
       }else{
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
       }

       if(!isStepValid){
          $('#wizard').smartWizard('showMessage','Please correct the errors in the steps and continue');
       }

       return isStepValid;
    }

    // Email Validation
    function isValidEmailAddress(emailAddress) {
      var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
      return pattern.test(emailAddress);
    }

	</script>
	<?php
		if(isset($_REQUEST['issubmit'])):


			$ap_rut			= $_POST['ap_rut'];
			$ap_nombre		= $_POST['ap_nombre'];
			$ap_apaterno	= $_POST['ap_apaterno'];
			$ap_fecha_nac 	= $_POST['ap_fecha_nac'];
			$ap_amaterno	= $_POST['ap_amaterno'];
			$ap_direccion	= $_POST['ap_direccion'];
			$ap_comuna		= $_POST['ap_comuna'];
			$ap_email		= $_POST['ap_correo'];
			$ap_celular		= $_POST['ap_celular'];
			$ap_telefono	= $_POST['ap_telefono'];
			$ap_telefono_t	= $_POST['ap_telefono_t'];

			$consulta2="INSERT INTO `apoderado`(
							`ap_rut`,
							`ap_nombre`,
							`ap_apaterno`,
							`ap_amaterno`,
							`ap_direccion`,
							`ap_comuna`,
							`ap_celular`,
							`ap_telefono`,
							`ap_telefono_trabajo`,
							`ap_correo`)
				VALUES (
							'".$ap_rut."',
							'".$ap_nombre."',
							'".$ap_apaterno."',
							'".$ap_amaterno."',
							'".$ap_direccion."',
							'".$ap_comuna."',
							'".$ap_celular."',
							'".$ap_telefono."',
							'".$ap_telefono_t."',
							'".$ap_email."')";
			if(mysql_query($consulta2,Conectar::conecta())):
				echo "insertar apoderado OK";
			else:
				echo "Error insertar apoderado ".mysql_error();
			endif;

			// $c="INSERT INTO `apoderado_alumno`(`aa_rut_apoderado`,`aa_rut_alumno`)
			// 						VALUES ('".$ap_rut."','".$rut."')";
			// if(mysql_query($c,Conectar::conecta())):
			// 	echo "<br />Todo Ok entre el alumno y apoderado";
			// else:
			// 	echo "<br />Error no está bien la consulta";
			// endif;
		endif;
	?>
</body>
</html>