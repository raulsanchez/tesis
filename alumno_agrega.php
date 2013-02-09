<?php
session_start();
require_once 'clases/conectar.class.php';
if(!isset($_SESSION['id_admin'])):
	echo "<script type=''>";
		echo "window.location='entrar.php?url=";
		echo $_SERVER['REQUEST_URI']."'";
	echo "</script>";
endif;
?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<script>
			function Autocomplete(param){
				$("#rut_status").load("ajax/rut_alumno.php", {sugerencia: param});
			};
			function Autocomplete_apo(param){
				$("#rut_status2").load("ajax/rut_apoderado.php", {sugerencia: param});
			};
			function Autocomplete_apo_suple(param){
				$("#rut_status3").load("ajax/rut_apoderado_suplente.php", {sugerencia: param});
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

		<!-- 	<ul>
				<a href="alumno_agrega.php"><li><img src="images/add.png" alt="nuevo"> Nuevo</li></a>
				<a href=""><li><img src="images/pencil.png" alt=""> Editar</li></a>
				<a href=""><li><img src="images/delete.png" alt=""> Eliminar</li></a>
			</ul> -->
	</div>
	<div id="contenido">
			<h2>Ingresando un alumno</h2>
			<form action="" method="POST" enctype="multipart/form-data">
				<input type='hidden' name="issubmit" value="1">
				<div id="wizard" class="swMain">
						<ul>
			  				<li>
			  					<a href="#step-1">
					                <label class="stepNumber">1</label>
			                		<span class="stepDesc">
			                   			Datos Alumno<br />
			                   			<small>Llene los campos </small>
			                		</span>
			            		</a>
			        		</li>
			  				<li>
			  					<a href="#step-2">
					                <label class="stepNumber">2</label>
					                <span class="stepDesc">
					                   Datos Apoderado<br />
					                   <small>Llene los campos</small>
					                </span>
			            		</a>
			        		</li>
			        		<li>
			  					<a href="#step-3">
					                <label class="stepNumber">3</label>
					                <span class="stepDesc">
					                   Apoderado Suple.<br />
					                   <small>Llene los campos</small>
					                </span>
			            		</a>
			        		</li>
			  				<li>
			  					<a href="#step-4">
					                <label class="stepNumber">4</label>
					                <span class="stepDesc">
					                   Configuración<br />
					                   <small>seleccione las opciones</small>
					                </span>
			             		</a>
			         		</li>
			  			</ul>

		  			<div id="step-1">
		            <h2 class="StepTitle">Paso 1: Detalles Alumno</h2>
		            <table cellspacing="3" cellpadding="3" align="center">
		          			<tr>
		                    	<td align="center" colspan="3">&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Rut Alumno :</td>
		                    	<td align="left">
		                    	  <input type="text" id="rut" name="rut" value="" class="txtBox" onblur="Autocomplete(this.value)" maxlength="10">
		                    	<div id="rut_status"></div>
		                      </td>
		                    	<td align="left"><span id="msg_rut"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Nombre :</td>
		                    	<td align="left">
		                    	  <input type="text" id="nombre" name="nombre" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_nombre"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Apellido Paterno :</td>
		                    	<td align="left">
		                    	  <input type="text" id="apaterno" name="apaterno" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_apaterno"></span>&nbsp;</td>
		          			</tr>
		               		<tr>
		                    	<td align="right">Apellido Materno :</td>
		                    	<td align="left">
		                    	  <input type="text" id="amaterno" name="amaterno" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_amaterno"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Fecha Nacimiento :</td>
		                    	<td align="left">
		                    	  <input type="text" id="fecha_nac" name="fecha_nac" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_fecha_nac"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Domicilio :</td>
		                    	<td align="left">
		                    	  	<textarea name="direccion" id="direccion" class="txtBox" rows="2"></textarea>
		                      </td>
		                    	<td align="left"><span id="msg_direccion"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Comuna :</td>
			                    	<td align="left">
				                        <select id="comuna" name="comuna" class="txtBox">
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
		                    	<td align="left"><span id="msg_comuna"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Correo :</td>
		                    	<td align="left">
		                    	  <input type="text" id="correo" name="correo" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_correo"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Celular :</td>
		                    	<td align="left">
		                    	  <input type="text" id="celular" name="celular" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_celular"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Telefono :</td>
		                    	<td align="left">
		                    	  <input type="text" id="telefono" name="telefono" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_telefono"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Foto :</td>
		                    	<td align="left">
		                    	  <input type="file" id="foto" name="foto" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_telefono"></span>&nbsp;</td>
		          			</tr>
		  			</table>
		        </div>
<!-- *******************************************  DATOS APODERADO  *********************************************** -->
		  			<div id="step-2">
		            <h2 class="StepTitle">Paso 2: Datos del apoderado</h2>
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
		                    	  <input type="text" id="ap_fecha_nac" name="ap_fecha_nac" value="" class="txtBox">
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
		                    	<td align="right">Celular (envio SMS) :</td>
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

<!-- **************************************  DATOS APODERADO SUPLENTE ***************************************** -->

		        <div id="step-3">
		            <h2 class="StepTitle">Paso 3: Datos del apoderado suplente</h2>
		            	<table cellspacing="3" cellpadding="3" align="center">
		          			<tr>
		                    	<td align="center" colspan="3">&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Rut Apoderado :</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_rut" name="aps_rut" value="" class="txtBox" onblur="Autocomplete_apo_suple(this.value)" >
		                    	<div id="rut_status3"></div>
		                      </td>
		                    	<td align="left"><span id="msg_aps_rut"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Nombre :</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_nombre" name="aps_nombre" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_aps_nombre"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Apellido Paterno :</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_apaterno" name="aps_apaterno" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_aps_apaterno"></span>&nbsp;</td>
		          			</tr>
		               		<tr>
		                    	<td align="right">Apellido Materno :</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_amaterno" name="aps_amaterno" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_aps_amaterno"></span>&nbsp;</td>
		          			</tr>
							<tr>
		                    	<td align="right">Fecha Nacimiento :</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_fecha_nac" name="aps_fecha_nac" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_aps_fecha_nac"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Domicilio :</td>
		                    	<td align="left">
		                    	  	<textarea name="aps_direccion" id="aps_direccion" class="txtBox" rows="2"></textarea>
		                      </td>
		                    	<td align="left"><span id="msg_aps_direccion"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Comuna :</td>
			                    	<td align="left">
				                        <select id="aps_comuna" name="aps_comuna" class="txtBox">
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
		                    	<td align="left"><span id="msg_aps_comuna"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Correo :</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_correo" name="aps_correo" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_aps_correo"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Celular :</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_celular" name="aps_celular" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_aps_celular"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Otro Celular :</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_celular2" name="aps_celular2" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_aps_celular2"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Telefono :</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_telefono" name="aps_telefono" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_aps_telefono"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Telefono Trabajo:</td>
		                    	<td align="left">
		                    	  <input type="text" id="aps_telefono_t" name="aps_telefono_t" value="" class="txtBox">
		                      	</td>
		                    	<td align="left"><span id="msg_aps_telefono_t"></span>&nbsp;</td>
		          			</tr>
		  			   </table>
		        </div>
	<!--- ****************************** Configuracion ***************************************************  -->
		  			<div id="step-4">
		            <h2 class="StepTitle">Paso 4: Configuracion</h2>
		            <table cellspacing="3" cellpadding="3" align="center">
		          			<tr>
		                    	<td align="center" colspan="3">&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Curso :</td>
		                    	<td align="left">
		                    		<select name="curso" id="curso" class="txtBox">
		                    			<?php
		                    			$consulta=mysql_query("SELECT `cu_codigo`, `cu_nombre`, `cu_anio`, `cu_descripcion`
		                    									FROM `curso`
		                    									WHERE cu_anio='2012'",Conectar::conecta());
		                    			while($respuesta=mysql_fetch_array($consulta)):
		                    			 ?>
		                    				<option value="<?php echo $respuesta['cu_codigo'] ?>"><?php echo $respuesta['cu_nombre'].' - '.$respuesta['cu_anio']?></option>
		                    			<?php
		                    			endwhile;
		                    			?>
		                    		</select>
		                      </td>
		                    	<td align="left"><span id="msg_curso"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Almuerzo en el establecimiento</td>
		                    	<td align="left">
		                    	  <input type="checkbox" id="alumerzo" name="alumaerzo" value="" class="txtBox">
		                      </td>
		                    	<td align="left"><span id="msg_phone"></span>&nbsp;</td>
		          			</tr>
		          			<tr>
		                    	<td align="right">Cuenta con uniforme completo</td>
		                    	<td align="left">
		                           <input type="checkbox" id="alumerzo" name="alumaerzo" value="" class="txtBox">
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

      if(step == 3){
        if(validateStep3() == false ){
          isStepValid = false;
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
        }
      }
      // validate step4
      if(step == 4){
        if(validateStep4() == false ){
          isStepValid = false;
          // $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
          // $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});
        }else{
          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
        }
      }

      return isStepValid;
    }

    function validateStep1(){
       var isValid = true;
       // Valida Rut
       var un = $('#rut').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_rut').html('Por favor ingrese el Rut del alumno').show();
       }else{
       		if(un.length < 9){
         		 isValid = false;
         		 $('#msg_rut').html('Por favor ingrese el Rut valido').show();
       		}else{
         		$('#msg_rut').html('').hide();
      		 }
       }
       // Validate nombre
       var un = $('#nombre').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_nombre').html('Por favor ingrese el/los nombre/s').show();
       }else{
         $('#msg_nombre').html('').hide();
       }
       var un = $('#apaterno').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_apaterno').html('Por favor ingrese apellido paterno').show();
       }else{
         $('#msg_apaterno').html('').hide();
       }
       var un = $('#amaterno').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_amaterno').html('Por favor ingrese apellido materno').show();
       }else{
         $('#msg_amaterno').html('').hide();
       }
       var un = $('#fecha_nac').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_fecha_nac').html('Por favor ingrese fecha de nacimiento').show();
       }else{
         $('#msg_fecha_nac').html('').hide();
       }
       var un = $('#direccion').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_direccion').html('Por favor ingrese el domicilio').show();
       }else{
         $('#msg_direccion').html('').hide();
       }
       var un = $('#comuna').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_comuna').html('Por favor seleccione la comuna').show();
       }else{
         $('#msg_comuna').html('').hide();
       }

       return isValid;
    }
    function validateStep2(){
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
    function validateStep3(){
       var isValid = true;
       // Valida Rut
       var un = $('#aps_rut').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_aps_rut').html('Por favor ingrese el Rut del apoderado suplente').show();
       }else{
         $('#msg_aps_rut').html('').hide();
       }
       // Validate nombre
       var un = $('#aps_nombre').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_aps_nombre').html('Por favor ingrese el/los nombre/s').show();
       }else{
         $('#msg_aps_nombre').html('').hide();
       }
       var un = $('#aps_apaterno').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_aps_apaterno').html('Por favor ingrese apellido paterno').show();
       }else{
         $('#msg_aps_apaterno').html('').hide();
       }
       var un = $('#aps_amaterno').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_aps_amaterno').html('Por favor ingrese apellido materno').show();
       }else{
         $('#msg_aps_amaterno').html('').hide();
       }
       var un = $('#aps_fecha_nac').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_aps_fecha_nac').html('Por favor ingrese fecha de nacimiento').show();
       }else{
         $('#msg_aps_fecha_nac').html('').hide();
       }
       var un = $('#aps_direccion').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_aps_direccion').html('Por favor ingrese el domicilio').show();
       }else{
         $('#msg_aps_direccion').html('').hide();
       }
       var un = $('#aps_comuna').val();
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_aps_comuna').html('Por favor seleccione la comuna').show();
       }else{
         $('#msg_aps_comuna').html('').hide();
       }

       return isValid;
    }
    function validateStep4(){
      var isValid = true;
      //validate email  email
      // var email = $('#email').val();
       // if(email && email.length > 0){
       //   if(!isValidEmailAddress(email)){
       //     isValid = false;
       //     $('#msg_email').html('Email is invalid').show();
       //   }else{
       //    $('#msg_email').html('').hide();
       //   }
       // }else{
       //   isValid = false;
       //   $('#msg_email').html('Please enter email').show();
       // }
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
       if(validateStep3() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});
       }else{
         $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
       }

       if(validateStep4() == false){
         isStepValid = false;
         $('#wizard').smartWizard('setError',{stepnum:3,iserror:true});
       }else{
         $('#wizard').smartWizard('setError',{stepnum:3,iserror:false});
       }

       if(!isStepValid){
          $('#wizard').smartWizard('showMessage','Por favor corriga los errores antes de continuar');
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
			$rut			= $_POST['rut'];
			$nombre			= $_POST['nombre'];
			$apaterno		= $_POST['apaterno'];
			$amaterno		= $_POST['amaterno'];
			echo $fnacimiento	= $_POST['fecha_nac'];
			$direccion		= $_POST['direccion'];
			$comuna			= $_POST['comuna'];
			$email			= $_POST['correo'];
			$celular		= $_POST['celular'];
			$telefono		= $_POST['telefono'];

			if(($_FILES["foto"]["name"])!=""):
				$foto 			= $_FILES["foto"]["name"];
				$temp 			= $_FILES["foto"]["tmp_name"];
				$tipo 			= $_FILES["foto"]["type"];
				switch ($tipo)
				{
					case 'image/jpeg':
						$ext=".jpg";
					break;
					case 'image/png':
						$ext=".png";
					break;

				}
				$nombre_foto 	= $_POST["rut"];
				$nombre_foto 	= $nombre_foto.$ext;
				copy($temp,"fotos/$nombre_foto");
			endif;

			$ap_rut			= $_POST['ap_rut'];
			$ap_nombre		= $_POST['ap_nombre'];
			$ap_apaterno	= $_POST['ap_apaterno'];
			$ap_amaterno	= $_POST['ap_amaterno'];
			$ap_fecha_nac	= $_POST['ap_fecha_nac'];
			$ap_direccion	= $_POST['ap_direccion'];
			$ap_comuna		= $_POST['ap_comuna'];
			$ap_email		= $_POST['ap_correo'];
			$ap_celular		= $_POST['ap_celular'];
			$ap_telefono	= $_POST['ap_telefono'];
			$ap_telefono_t	= $_POST['ap_telefono_t'];

			$aps_rut		= $_POST['aps_rut'];
			$aps_nombre		= $_POST['aps_nombre'];
			$aps_apaterno	= $_POST['aps_apaterno'];
			$aps_amaterno	= $_POST['aps_amaterno'];
			$aps_fecha_nac	= $_POST['aps_fecha_nac'];
			$aps_direccion	= $_POST['aps_direccion'];
			$aps_comuna		= $_POST['aps_comuna'];
			$aps_email		= $_POST['aps_correo'];
			$aps_celular	= $_POST['aps_celular'];
			$aps_telefono	= $_POST['aps_telefono'];
			$aps_telefono_t	= $_POST['aps_telefono_t'];

				if(($_FILES["foto"]["name"])!=""):
				$consulta="INSERT INTO `alumno`(`al_rut`,
												`al_nombre`,
												`al_apaterno`,
												`al_amaterno`,
												`al_fecha_nacimiento`,
												`al_direccion`,
												`al_comuna`,
												`al_celular`,
												`al_telefono`,
												`al_correo`,
												`al_foto`
												)
							VALUES ('".$rut."',
									'".$nombre."',
									'".$apaterno."',
									'".$amaterno."',
									'".cambiarfecha_mysql($fnacimiento)."',
									'".$direccion."',
									'".$comuna."',
									'".$celular."',
									'".$telefono."',
									'".$email."',
									'".$nombre_foto."')";
				else:
					$consulta="INSERT INTO `alumno`(`al_rut`,
												`al_nombre`,
												`al_apaterno`,
												`al_amaterno`,
												`al_fecha_nacimiento`,
												`al_direccion`,
												`al_comuna`,
												`al_celular`,
												`al_telefono`,
												`al_correo`
												)
							VALUES ('".$rut."',
									'".$nombre."',
									'".$apaterno."',
									'".$amaterno."',
									'".cambiarfecha_mysql($fnacimiento)."',
									'".$direccion."',
									'".$comuna."',
									'".$celular."',
									'".$telefono."',
									'".$email."')";
				endif;
				if(mysql_query($consulta,Conectar::conecta())):
					echo "exito insertar alumno";
				else:
					?>
						<script>
							new Messi('error insertar alumno -> <?php echo mysql_error(); ?>', {title: 'Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X'}]});
						</script>
					<?php
					$error[]="ingreso alumno";
					exit();
				endif;
				$con=mysql_query("SELECT `ap_rut` FROM `apoderado` WHERE `ap_rut`='".$ap_rut."'",Conectar::conecta());
				if(mysql_num_rows($con)==0)	:
					$consulta2="INSERT INTO `apoderado`(
											`ap_rut`,
											`ap_nombre`,
											`ap_apaterno`,
											`ap_amaterno`,
											ap_fecha_nac,
											`ap_direccion`,
											`ap_comuna`,
											`ap_celular`,
											`ap_telefono`,
											`ap_telefono_trabajo`,
											`ap_correo`,
											`ap_clave`)
								VALUES (
											'".$ap_rut."',
											'".$ap_nombre."',
											'".$ap_apaterno."',
											'".$ap_amaterno."',
											'".cambiarfecha_mysql($ap_fecha_nac)."',
											'".$ap_direccion."',
											'".$ap_comuna."',
											'".$ap_celular."',
											'".$ap_telefono."',
											'".$ap_telefono_t."',
											'".$ap_email."',
											'".$ap_fecha_nac."'
											)";
					if(mysql_query($consulta2,Conectar::conecta())):
						echo "insertar apoderado OK";
					else:
						?>
						<script>
							new Messi('error insertar apoderado', {title: 'Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X'}]});
						</script>
						<?php
						echo mysql_error();
						$error[]="ingreso apoderado";
						exit();
					endif;
				else:
					echo "<br />el apoderado ya existia :)";
				endif;
				$consulta_aps=mysql_query("SELECT `ap_rut` FROM `apoderado` WHERE `ap_rut`='".$aps_rut."'",Conectar::conecta());
				if(mysql_num_rows($consulta_aps)==0)	:
					$consulta3="INSERT INTO `apoderado`(
											`ap_rut`,
											`ap_nombre`,
											`ap_apaterno`,
											`ap_amaterno`,
											 ap_fecha_nac,
											`ap_direccion`,
											`ap_comuna`,
											`ap_celular`,
											`ap_telefono`,
											`ap_telefono_trabajo`,
											`ap_correo`,
											ap_clave
											)
								VALUES (
											'".$aps_rut."',
											'".$aps_nombre."',
											'".$aps_apaterno."',
											'".$aps_amaterno."',
											'".cambiarfecha_mysql($aps_fecha_nac)."',
											'".$aps_direccion."',
											'".$aps_comuna."',
											'".$aps_celular."',
											'".$aps_telefono."',
											'".$aps_telefono_t."',
											'".$aps_email."',
											'".$aps_fecha_nac."'
											)";
					if(mysql_query($consulta3,Conectar::conecta())):
						echo "insertar apoderado suplente Ok";
					else:
						?>
						<script>
							new Messi('error insertar apoderado suplente -> <?php echo mysql_error(); ?>', {title: 'Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X'}]});
						</script>
					<?php
					$error[]="ingreso apoderado suplente";
					exit();
					endif;
				else:
					echo "<br />el apoderado suplente ya existia :)";
				endif;

				$consu="INSERT INTO `alumno_curso`(`ac_codigo_curso`, `ac_rut_alumno`)
						VALUES ('$curso','$rut')";
				if(mysql_query($consu,Conectar::conecta())):
					echo "<br>El alumno se inscribio en el curso correctamente";
				else:
					?>
				<script>
					new Messi('error consulta con el curso -><?php echo mysql_error(); ?>', {title: 'Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X'}]});
				</script>
					<?php
					$error[]="ingreso curso";
					exit();
				endif;
				$c="INSERT INTO `apoderado_alumno`(`aa_rut_apoderado`, `aa_rut_alumno`, `aa_tipo_apoderado`)
											VALUES ('".$ap_rut."','".$rut."','0')";
				if(mysql_query($c,Conectar::conecta())):
					echo "<br />Todo Ok entre el alumno y apoderado";
				else:
					?>
				<script>
					new Messi('error consulta apoderado_alumno -><?php echo mysql_error(); ?>', {title: 'Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X'}]});
				</script>
					<?php
					$error[]="ingreso apoderado_alumno";
					exit();
				endif;
				$d="INSERT INTO `apoderado_alumno`(`aa_rut_apoderado`, `aa_rut_alumno`, `aa_tipo_apoderado`)
											VALUES ('".$aps_rut."','".$rut."','1')";
				if(mysql_query($d,Conectar::conecta())):
					echo "<br />Todo Ok entre el alumno y apoderado suplente";
				else:
					?>
				<script>
					new Messi('error consulta apoderado-suplente_alumno -><?php echo mysql_error(); ?>', {title: 'Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X'}]});
				</script>
					<?php
					$error[]="ingreso apodrado-suplente_alumno";
					exit();
				endif;
				if(count($error)==0):
				?>
				<script>
					new Messi('Se agrego correctamente al alumno.', {title: 'Éxito', titleClass: 'success', buttons: [{id: 0, label: 'Cerrar', val: 'X'}],autoclose:'3000'});
					function redireccionarPagina() {
	 					 window.location = "alumno.php";
	 				}
					//setTimeout("redireccionarPagina()", 4000);
				</script>
				<?php
				else:
					print_r($error);
				endif;

				$url=isset($_GET['url']) ? $_GET['url'] : null ;
		endif;
	?>
</body>
</html>