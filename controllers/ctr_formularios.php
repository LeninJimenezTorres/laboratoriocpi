<?php 

class ControladorFormulario{
    //CONSULTO SI EXISTE UN DATO 
    static public function ctrDatoExistente($tabla,$column,$valor){
        //echo '<br>Ingreso al controlador  la variable: '.$valor.'<br>';
        $respuesta=ModeloFormularios::mdlUserDataSpecific($tabla,$column,$valor);
        //echo 'El resultado del modelo es: ';
        //print_r($respuesta);
        //echo '<br><br>';
        return $respuesta;
    }

    //BUSQUEDA POR FILTRO USER
    static public function ctrBusquedaUserReception($TipoFecha, $name){
        if (isset($_POST['search'])){
            //PRIMERO VALIDO LA ENTRADA
            if (preg_match('/^[0123456789\\/]/',$_POST["fecha"]) && !empty($_POST['fecha']))
                { 
                    
                    //REALIZO LA CONSULTA
                    $consulta = ModeloFormularios::mdlResultQueryDouble('resultados',$TipoFecha, $_POST['fecha'], 'dr', $name); 
                    if (!empty($consulta))
                    {   
                        echo '<div class="alert-success text-center">Búsqueda exitosa<br></div>'; 
                        include '../views/modulos/show_query_user.php';
                    }
                    else{        
                        echo '<div class="alert-warning text-center">No existen datos en esa fecha<br></div>'; 
                    }
                }
            else {
                echo '<script>if(window.history.replaceState){
                    window.history.replaceState( null, null, window.location.href);
                }</script>';
                echo '<div class="alert-danger text-center">Error de ingreso, se ha detectado caracteres no permitidos <br></div>'; 
            }
        }
    }

    //BUSQUEDA POR FILTRO USER
    static public function ctrBusquedaUserPatient($name){
        if (isset($_POST['search'])){
            $consulta = ModeloFormularios::mdlResultQueryDouble('resultados','patient', $_POST['buscar'], 'dr', $name); 
            if (!empty($consulta))
            {   
                include '../views/modulos/show_query_user.php';
            }
            else{        
                echo '<div class="alert-warning text-center">El usuario no existe en pacientes<br></div>'; 
            }
        }
    }

    //BUSQUEDA POR FILTRO ADMIN
    static public function ctrBusquedaFiltro(){
        if(isset($_GET['type'])){
            //echo 'El tipo es: ';print_r($_GET['type']);
            if (!empty($_POST['valor'])){
                //echo '<br>El dato a buscar es: ';print_r($_POST['valor']);
                
                if ($_POST['buscar']){
                    if($_GET['type']=='patient'){
                        if(isset($_POST['valor'])){
                            $consulta = ModeloFormularios::mdlResultQuery('resultados','patient', $_POST['valor']); 
                            //$do=ModeloFormularios::mdlSpecificValueQuery('resultados','dr','patient',$_POST['valor']);
                            if (!empty($consulta))
                            {   
                                //echo '<br>El medico es: '; print_r($do['dr']);
                                //echo '<br>Consulta en base de datos de pacientes: <br>';print_r($consulta);
                                include '../views/modulos/show_query_admin.php';

                            }
                            else{        
                                echo '<div class="alert-warning text-center">El usuario no existe en pacientes<br></div>'; 
                            }
                        }
                    }
                    else if ($_GET['type']=='doctor'){
                        if(isset($_POST['valor'])){
                            $consulta = ModeloFormularios::mdlResultQuery('resultados','dr', $_POST['valor']); 
                            if (!empty($consulta))
                            {
                                //echo 'Consulta en base de datos de doctores: <br>';print_r($consulta);
                                include '../views/modulos/show_query_admin.php';
                            }
                            else{        
                                echo '<div class="alert-warning text-center">El usuario no existe en doctores<br></div>'; 
                            }
                        }
                    }    
                }
            }            
        }
        else{
            echo '<div class="alert text-center">Seleccione el filtro<br></div>'; 
        }
    }

    //BUSQUEDA DE USUARIO INICIO
    static public function ctrlBusquedaUserPanel($idt){
        if (isset($_POST['search'])){
            if (!empty($_POST['buscar'])){
                $consulta = ModeloFormularios::mdlUserDataSpecific('usuarios','name', $_POST['buscar']); 
                if (!empty($consulta))
                {
                    //echo '<script> setTimeout(function(){window.location = "../views/panel_admin.php?modulos=buscarinicio_admin&idt='.$idt.'";},10)</script>';
                    include '../views/modulos/buscarInicio_admin.php';
                }
                else{        
                    echo '<div class="alert-warning text-center">El usuario no existe<br></div>'; 
                }
            }   
        }
    }

        //BUSQUEDA DE USUARIO INICIO
        static public function ctrlBusquedaResultPanel($doc,$idt){
            if (isset($_POST['search'])){
                if (!empty($_POST['buscar'])){
                    $consulta = ModeloFormularios::mdlResultQueryDouble('resultados','patient', $_POST['buscar'], 'dr', $doc); 
                    //print_r($consulta);
                    if (!empty($consulta))
                    {
                        //echo '<script> setTimeout(function(){window.location = "../views/modulos/buscarInicio_user.php&name='.$doc.'&idt='.$idt.'";},3000)</script>';
                        include '../views/modulos/buscarInicio_user.php';
                    }
                    else{        
                        echo '<div class="alert-warning text-center">El usuario no existe<br></div>'; 
                    }
                }   
            }
        }
    

    //ESTE CTRL REGISTRA USUARIOS VALIDANDO LOS FORMULARIOS
    static public function ctrRegistroUsuarioValidado($idt){
        if(isset($_POST["submit"]))
        {
            if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',$_POST["nombre"])
            && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',$_POST["especialidad"])
            && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',$_POST["casa"])
            && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9]+$/',$_POST["pass"]))
            { 
                $tabla = "usuarios"; //el mismo nombre que la tabla en MyphpAdmin
                $datos = array(
                    "name" => $_POST["nombre"],
                    "specialty" => $_POST["especialidad"],
                    "home" => $_POST["casa"],
                    "password" => $_POST["pass"],
                    "email" => $_POST["email"],
                    "phone" => $_POST["telf"]);  
                
                array_push($datos,$datos["token"] = (md5($_POST['nombre'].'+'.$_POST['pass'])));
                if (strlen($datos['name'])<7 || strlen($datos['specialty'])<4 ||
                strlen($datos["home"])<7 || strlen($datos["password"])<7 )
                {
                    $errorDatos=array('name','specialty','home','password');
                    if (strlen($datos['name'])<7){
                        $errorDatos['name'] = 'Ingrese el nombre y apellido';
                    }
                    if (strlen($datos['specialty'])<4){
                        $errorDatos['specialty'] = 'Ingrese la especialidad';
                    }
                    if (strlen($datos['home'])<7){
                        $errorDatos['home'] = 'Ingrese la casa de salud a la que pertenece';
                    }
                    if (strlen($datos['password'])<7){
                        $errorDatos['password'] = 'Ingrese una contraseña con mas de 7 caracteres';
                    }
                    $cadenaError = "";
                    foreach($errorDatos as $err){
                        if(!empty($errorDatos[$err])){
                            $cadenaError = $cadenaError.$errorDatos[$err]."<br>";
                        }
                    }
                    if (!empty($cadenaError)){echo '<p class="alert-warning text-center">'.$cadenaError.'</p>';}
                    
                    //return $errorDatos;            
                    //print_r($errorDatos);
                }
                if (strlen($datos['name'])>=7 && strlen($datos['specialty'])>=4 &&
                strlen($datos["home"])>=7 && strlen($datos["password"])>=7 )
                {
                    $respuesta = ModeloFormularios::mdlUserQueryExistent($tabla, $datos, $column = 'name',
                    $valor = $_POST['nombre']); 
                    if (empty($respuesta['name']))
                    { 
                        include '../views/modulos/bootstrap.php';
                        ModeloFormularios::mdlSignUpUser($tabla, $datos); 
                        echo '<script>if(window.history.replaceState){
                                window.history.replaceState( null, null, window.location.href);
                            }</script>';
                        echo '<div class="alert-success text-center">Registro exitoso</div>';
                        echo '<script> setTimeout(function(){window.location = "../views/panel_admin.php?modulos=inicio_admin&idt='.$idt.'";},3000)</script>';
                    }
                    if (!empty($respuesta['name'])){
                        echo '<div class="alert-danger text-center">El usuario si existe, ingrese otro nombre diferente a: <br></div>'; 
                        echo '<div class="alert-danger text-center">'.$respuesta['name'].'</div>';
                        echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
                    }
                }
            }
            else {
                echo '<div class="alert-danger text-center">Error de ingreso, se ha detectado caracteres no permitidos <br></div>'; 
            }
        }
    }
    //ESTA INGRESA LOS DATOS DE LOS RESULTADOS EN LA DB
    static public function ctrIngresoDatosResultados($idt){
        if(isset($_POST["upload"]))
        {
            $tabla = "resultados"; //el mismo nombre que la tabla en MyphpAdmin
            $datos = array(
                "dr" => $_POST["dr"],
                "patient" => $_POST["paciente"],
                "reception" => $_POST["date"],
                "deliver" => $_POST["date-out"],
                "code" => $_POST["informe"]);

                
            if (strlen($datos['dr'])<7 || strlen($datos['patient'])<7 ||
            strlen($datos['code'])<2 || empty($datos['reception']) 
            || empty($datos['deliver']))
            {
                $errorDatos=array('dr','patient','reception','code');
                if (strlen($datos['dr'])<7){
                    $errorDatos['dr'] = 'Ingrese el nombre y apellido del médico solicitante';
                }
                if (strlen($datos['patient'])<7){
                    $errorDatos['patient'] = 'Ingrese el nombre y apellido del paciente';
                }
                if (strlen($datos['code'])<2){
                    $errorDatos['code'] = 'ingrese el codigo interno del informe del resultado';
                }
                if (empty($datos['reception'])){
                    $errorDatos['reception'] = 'Ingrese la fecha de recepción';
                }
                if (empty($datos['deliver'])){
                    $errorDatos['deliver'] = 'Ingrese la fecha de entrega del informe';
                }
                $cadenaError = "";
                foreach($errorDatos as $err){
                    if(!empty($errorDatos[$err])){
                        $cadenaError = $cadenaError.$errorDatos[$err]."<br>";
                    }
                }
                if (!empty($cadenaError)){
                    echo '<p class="alert-warning text-center">'.$cadenaError.'</p>';
                    echo '<script>if(window.history.replaceState){
                        window.history.replaceState( null, null, window.location.href);
                        setTimeout(function(){location.reload()},4000);}</script>';
                }
                
            }
            if (strlen($datos['dr'])>=7 && strlen($datos['patient'])>=7 &&
            strlen($datos['code'])>=2 && !empty($datos['reception']) && !empty($datos['deliver']))
            {
                //VERIFICANDO SI EXISTEN EL CODIGO DE INFORME Y EL NOMBRE DE USUARIO DR
                $verificacionCodigoInforme = ModeloFormularios::mdlUserQueryExistent($tabla, $datos, $column = 'code',
                $_POST['informe']); 
                $verificacionMedicoRegistrado = ModeloFormularios::mdlUserQueryExistent('usuarios', null, $column = 'name',
                $_POST['dr']); 
                
                if (empty($verificacionCodigoInforme['code']))
                {
                    if(!empty($verificacionMedicoRegistrado['name'])){
                        
                        //VERIFICACION DE INGRESO DE CARACTERES NO PERMITIDOS - SCRIPTS

                        if ( preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',$_POST["dr"])
                        && preg_match('/^[0a-zA-Z1-9]+$/',$_POST["informe"])
                        && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',$_POST["paciente"])
                        && preg_match('/^[0123456789\\/ ]/',$_POST["date"])
                        && preg_match('/^[0123456789\\/ ]/',$_POST["date-out"])) //mm dd yy
                        ///([0-1]{1})([0-9]{1})-([0-3]{1})([0-9]{1})-([2]{1})([0-1]{1})([0-9]{2})/
                        //([1-9]|0[1-9]|1[0-2])(\/)([1-9]|0[1-9]|[1-2][0-9]|3[0-1])(\/)([0-9]{4})
                        {  
                            include '../views/modulos/bootstrap.php';
                            array_push($datos,$datos["result"] = ($datos['dr'].'-'.$datos['patient'].'-'.$datos['code']));//nombre del archivo en la db              .'-'.$datos['reception']
                            $dirConsulta=glob('../views/results/'.$datos['dr']);
                            $newDir = '../views/results/'.$datos["dr"];
                            
                            //CREACION DE DIRECTORIO
                            if (empty($dirConsulta[0])){
                                echo '<div class="alert-success text-center">Creando directorio para el dr. '.$datos['dr'].'</div>';
                                mkdir($newDir,0777,true);  
                            }
                            else{
                                echo '<div class="alert-success text-center">Directorio existente</div>';
                            }

                            if (!empty($file_tmp = $_FILES["file"]["tmp_name"]) && !empty($file_tmp = $_FILES["file"]["name"])){
                                //REGISTRO DE DATOS EN DB
                                //mkdir($newDir,0644);
                                ModeloFormularios::mdlRegistroDatosResultados($tabla, $datos); 

                                //CARGA DE ARCHIVO EN DB
                                $file_tmp = $_FILES["file"]["tmp_name"];
                                $filename = $_FILES["file"]["name"];
                                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                                //echo '<br>'.$file_tmp.'<br>';
                                //echo '<br>La extension es: '.$extension;
                                //ControladorFormulario::ctrlSaveFile($datos['result'],$file_tmp,$newDir.'/'.$datos['result']);
                                move_uploaded_file($file_tmp,$newDir.'/'.$datos['result'].'.'.$extension);
                                
                                
                                //POST ENTREGA
                                echo '<script>if(window.history.replaceState){
                                        window.history.replaceState( null, null, window.location.href);
                                    }</script>';
                                echo '<div class="alert-success text-center">Registro exitoso</div>';
                                echo '<script> setTimeout(function(){window.location = "../views/panel_admin.php?modulos=inicio_admin&idt='.$idt.'";},3000)</script>';
                            
                            }
                            else{
                                echo '<script>if(window.history.replaceState){
                                    window.history.replaceState( null, null, window.location.href);
                                }</script>';
                                echo '<div class="alert-warning text-center">No ha seleccionado el archivo</div>';
                            }
                        }
                        else {
                            echo '<script>if(window.history.replaceState){
                                window.history.replaceState( null, null, window.location.href);
                            }</script>';
                            echo '<div class="alert-danger text-center">Error de ingreso, se ha detectado caracteres no permitidos <br></div>'; 
                        }
                    }
                    else
                    {
                        echo '<div class="alert-danger text-center">El médico no se encuentra registrado</div>';
                    }
                       
                }
                if (!empty($respuesta['code'])){
                    echo '<div class="alert-danger text-center">El código de informe ya existe, ingrese otro diferente a: <br></div>'; 
                    echo '<div class="alert-danger text-center">'.$respuesta['code'].'</div>';
                    echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
                }
                echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
                
            }
            echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
                
        }
    }

    //ESTE CTRL PERMITE LA DESCARGA DEL DOCUMENTO
    static public function ctrDownload(){
        if (isset($_POST["download"])){
            //echo 'El valor enviado de download es: ';print_r($_POST['download']);echo'<br><br>';
            $filename = ModeloFormularios::mdlSpecificValueQuery('resultados','result','code',$_POST['download']);
            //print_r ($filename['result']); echo '<br><br>';
            $user= ModeloFormularios::mdlSpecificValueQuery('resultados','dr','code',$_POST['download']);
            //print_r($user['dr']); echo '<br><br>';
            $location = 'http://localhost/cpi_login/views/results/'.$user["dr"].'/';
            //$extension = pathinfo($location.$filename, PATHINFO_EXTENSION);
            $dir=$location.$filename['result'].'.pdf';
            //echo '<br><br>'.$dir;
            //fopen($dir, 'r');
            echo '<script> window.open("'.$dir.'", "Diseño Web") </script>';
        }      
        else
        {
            return null;
        }                  
    }

    //ESTA CLASE REUNE LOS DATOS DE LA TABLA Y DE LAS VARIABLES PARA SER CONSULTADAS, SE LA SEPARA EN ESTE CONTROLADOR Y CLASE
    // POR SEGURIDAD PARA QUE NADIE PUEDA VER LOS NOMBRES DE LAS VARIABLES DE LAS BASES DE DATOS
    static public function ctrRegistro(){
        if(isset($_POST["submit"]))
        {
            $tabla = "usuarios"; //el mismo nombre que la tabla en MyphpAdmin
            $datos = array(
                "name" => $_POST["nombre"],
                "specialty" => $_POST["especialidad"],
                "home" => $_POST["casa"],
                "password" => $_POST["pass"],
                "email" => $_POST["email"],
                "phone" => $_POST["telf"]);

            if (strlen($datos['name'])<7 || strlen($datos['specialty'])<4 ||
            strlen($datos["home"])<7 || strlen($datos["password"])<7 )
            {
                $errorDatos=array('name','specialty','home','password');
                if (strlen($datos['name'])<7){
                    $errorDatos['name'] = 'Ingrese el nombre y apellido';
                }
                if (strlen($datos['specialty'])<4){
                    $errorDatos['name'] = 'Ingrese la especialidad';
                }
                if (strlen($datos['home'])<7){
                    $errorDatos['home'] = 'Ingrese la casa de salud a la que pertenece';
                }
                if (strlen($datos['password'])<7){
                    $errorDatos['password'] = 'Ingrese una contraseña con mas de 7 caracteres';
                }
                return $errorDatos;            
            }
            if (strlen($datos['name'])>=7 && strlen($datos['specialty'])>=4 &&
            strlen($datos["home"])>=7 && strlen($datos["password"])>=7 )
            {
                $respuesta = ModeloFormularios::mdlSignUpUser($tabla, $datos); 
                return $respuesta;
            }        
        }
    }

    //ESTE CTRL TRAE TODOS LOS REGISTROS DE INFORMES DE LA TABLA RESULTADOS
    static public function ctrShowResults($name){
        $tabla = "resultados"; //CREO LA VARIABLE QUE OCULTARA EL NOMBRE DE LA BASE DE DATOS
        //echo $name;
        $respuesta = ModeloFormularios::mdlResultQuery($tabla, 'dr', $name); //ENVIO EL NOMBRE OCULTO DE LA DB, AL MODELO QUE REALIZA LA CONSULTA
        return $respuesta; 
    }


    //ESTE CLASE CTRL SIRVE PARA OCULTAR EL NOMBRE DE LA TABLA DE LA DB, ES INTERMEDIARIA CON EL MODELO DE CONSULTA DE TODOS
    //LOS DATOS DE LA DB, Y ALMACENA LOS RESULTADOS SIN QUE EL MODELO QUE CONSULTA DIRECTAMENTE LOS DATOS SE EXPONGA DE NINGUNA MANERA.
    static public function ctrSeleccionarRegistros(){
        $tabla = "usuarios"; //CREO LA VARIABLE QUE OCULTARA EL NOMBRE DE LA BASE DE DATOS
        $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla); //ENVIO EL NOMBRE OCULTO DE LA DB, AL MODELO QUE REALIZA LA CONSULTA
        return $respuesta; 
    }

    //LOS DATOS DE LA DB, Y ALMACENA LOS RESULTADOS SIN QUE EL MODELO QUE CONSULTA DIRECTAMENTE LOS DATOS SE EXPONGA DE NINGUNA MANERA.
    static public function ctrConsultaDatosEspecificosUser($tabla,$column,$value){
        $respuesta = ModeloFormularios::mdlResultQuery($tabla,$column,$value);
        return $respuesta; 
    }

    //ESTE CTRL CONSULTA CUALQUIER DATO POR MEDIO DEL MDL ModeloFormularioMain
    static public function ctrConsultaDatos($tabla, $column, $valor)
    {
        require_once '../Models/modelo_formulario.php';
        $respuesta = ModeloFormularioMain::mdlConsultaEspecfDB($tabla, $column, $valor);
        return $respuesta;    
    }

    //ESTA CLASE CTRL EDITAR LA INFORMACION DEL USUARIO
    static public function ctrUpdateResult($idt)
    {
        if (isset($_POST['actualizar_result']))
        {
            $tabla = "resultados"; //el mismo nombre que la tabla en MyphpAdmin
            $datos = array(
                "patient" => $_POST["update_patient"],
                "reception" => $_POST["update_reception"],
                "deliver" => $_POST["update_deliver"]);
            
            $column = 'code';
            $valor = $_POST['code'];
            //echo '<br><br>Codigo de examen: '.$valor;
            //echo '<br>El nombre ingresado es: ';print_r($_POST['update_patient']);

            $datosAnteriores = ControladorFormulario::ctrConsultaDatos($tabla, $column, $valor);
            //echo '<br>Los datos anteriores son: ';print_r($datosResultado);
            //echo '<br><br><br>Los datos nuevos son: ';print_r($datos);
            
            //VALIDANDO EL INGRESO
            if ( preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/',$_POST['update_patient'])
                && preg_match('/^[0123456789\\/ ]/',$_POST["update_reception"])
                && preg_match('/^[0123456789\\/ ]/',$_POST["update_deliver"])) //mm dd yy
            {
                echo '<div class="alert-success text-center">No se ha modificado el nombre del paciente<br></div>'; 
                    
                //SI NO CAMBIA EL PACIENTE NO CAMBIA EL REGISTRO EN LA BASE DE DATOS PERO__________________________________________________________________
                if($_POST['update_patient']==$datosAnteriores['patient']
                || empty($_POST['update_patient'])
                || $_POST["update_patient"]=='Ingrese el nombre del paciente')
                {
                    //Si no cambia el paciente, no cambia nada, pero se rellena el array de datos
                    echo '<div class="alert-sucees text-center">Usted no ha modificado el nombre del paciente<br></div>'; 
                    $datos["patient"]=$datosAnteriores['patient'];
                    array_push($datos,$datos['result'] = $datosAnteriores['result']); 
                    
                    //echo 'ARCHIVO C1: ';print_r($_FILES["file"]["tmp_name"]);

                    //SI CAMBIA EL ARCHIVO LE PONGO EL MISMO NOMBRE Y BORRO AL ANTERIOR
                    if (!empty($file_tmp = $_FILES["file"]["tmp_name"]) && !empty($file_tmp = $_FILES["file"]["name"]))//isset($_FILE['file_update']))
                    {
                        echo '<div class="alert-success text-center">Ha seleccionado un documento  1</div>'; 
                               
                        $locationDir = '../views/results/'.$datosAnteriores['dr'].'/';
                        $locationFilePath=$locationDir.$datosAnteriores['result'].'.pdf';
                        //echo $dir;
                        //PRIMERO LOCALIZO EL ARCHIVO EN LA DB
                        if ((glob($locationFilePath)))
                        {
                            echo '<div class="alert-success text-center">El documento anterior fue localizado</div>'; 
                            //No necesito eliminar el registro de la tabla en la db porque va el archivo con el mismo nombre
                            //$eliminar = ModeloFormularios::mdlEliminarRegistro('resultados','code',$_POST["eliminar"]); 
                            if (unlink($locationFilePath))
                            {
                                echo '<div class="alert-success text-center">Informe anterior eliminado exitosamente</div>'; 
                                //LUEGO AGREGO EL NUEVO ARCHIVO
                                $file_tmp = $_FILES["file"]["tmp_name"];
                                $filename = $_FILES["file"]["name"];
                                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                                if((move_uploaded_file($file_tmp,$locationDir.'/'.$datos['result'].'.'.$extension)))
                                {
                                    echo '<div class="alert-success text-center">Documento subido exitosamente</div>';  
                                }
                                else{
                                    echo '<div class="alert-warning text-center">El documento no pudo ser cargado</div>'; 
                                }
                            }
                            else{
                                echo '<div class="alert-warning text-center">El documento alterior no pudo ser eliminado</div>';    
                            }
                        }
                        else{
                            echo '<div class="alert-warning text-center">El documento anterior no fue localizado</div>'; 
                        }
                        //$locationFilePath=null;
                    }
                    else{
                        echo '<div class="alert-success text-center">No ha seleccionado un documento nuevo 2</div>'; 
                    }
                    //Pero si no cambia el archivo, tan solo paso el nombre anterior
                }
                //SI CAMBIA EL PACIENTE CAMBIA EL REGISTRO EN LA BASE DE DATOS PERO__________________________________________________________________
                else if($_POST["update_patient"]!=$datosAnteriores['patient'] 
                || !empty($_POST['update_patient']))
                {
                    echo '<div class="alert-success text-center">Usted ha modificado el nombre del paciente<br></div>'; 
                    
                    //CARGO EL NUEVO NOMBRE PARA LA DB
                    array_push($datos,$datos['result'] = ($datosAnteriores['dr'].'-'.$datos['patient'].'-'.$datosAnteriores['code'])); 
                    echo '<div class="alert-success text-center">Se ha cambiado el nombre del paciente<br></div>'; 

                    //echo 'ARCHIVO C2: ';print_r($_FILES["file"]["tmp_name"]);

                    //SI EL ARCHIVO HA CAMBIADO, TENGO QUE BORRARLO Y SUBIR EL NUEVO CON OTRO NOMBRE
                    if (!empty($file_tmp = $_FILES["file"]["tmp_name"]) && !empty($file_tmp = $_FILES["file"]["name"]))//if(isset($_FILE['file_update']))
                    {
                        echo '<div class="alert-success text-center">Ha seleccionado un documento nuevo 3</div>'; 
                        
                        $locationDir = '../views/results/'.$datosAnteriores['dr'].'/';
                        $locationFilePath=$locationDir.$datosAnteriores['result'].'.pdf';
                        //LOCALIZO EL ARCHIVO EN LA DB
                        if (glob($locationFilePath))
                        {
                            echo '<div class="alert-succes text-center">El archivo anterior ha sido localizado para renombrarlo</div>';//print_r($dirConsulta[0]);echo '<br>';
                            //AHORA ELIMINO
                            if (unlink($locationFilePath))
                            {
                                echo '<div class="alert-success text-center">Informe anterior eliminado exitosamente</div>'; 
                                //LUEGO AGREGO EL NUEVO ARCHIVO
                                $file_tmp = $_FILES["file"]["tmp_name"];
                                $filename = $_FILES["file"]["name"];
                                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                                if((move_uploaded_file($file_tmp,$locationDir.'/'.$datos['result'].'.'.$extension))){
                                    echo '<div class="alert-success text-center">Documento subido exitosamente</div>';  
                                }
                                else{
                                    echo '<div class="alert-warning text-center">El documento no pudo ser cargado</div>'; 
                                }
                            }
                            else{
                                echo '<div class="alert-warning text-center">El documento anterior no pudo ser eliminado</div>';    
                            }
                        }
                        else{
                            echo '<div class="alert-warning text-center">El documento anterior no fue localizado</div>'; 
                        }
                    }
                    //SI EL ARCHIVO NO HA CAMBIADO, SOLO CAMBIO EL REGISTRO EN LA DB Y EL NOMBRE DEL ARCHIVO EXISTENTE
                    else{
                        echo '<div class="alert-success text-center">No ha seleccionado un documento nuevo 4</div>'; 
                        
                        //LOCALIZO EL ARCHIVO EN LA DB
                        $locationDir = '../views/results/'.$datosAnteriores['dr'].'/';
                        $locationFilePath=$locationDir.$datosAnteriores['result'].'.pdf';
                        //LO RENOMBRO SI LO ENCUENTRO
                        if (glob($locationFilePath)){
                            echo '<div class="alert-succes text-center">El archivo anterior ha sido localizado para renombrarlo</div>';//print_r($dirConsulta[0]);echo '<br>';
                            if(rename($locationFilePath,$locationDir.$datos['result'].'.pdf')){
                                echo '<div class="alert-success text-center">El archivo anterior ha sido renombrado</div>';
                            }
                            else{
                                echo '<div class="alert-warning text-center">El archivo anterior no ha sido renombrado</div>';
                            }
                        }
                        else{
                            echo '<div class="alert-warning text-center">No se ha encontrado el documento anterior para renombrarlo<br></div>'; 
                        }
                    }
                }
                if(empty($datos['reception'])){
                    $datos["reception"]=$datosAnteriores['reception'];
                    echo '<div class="alert-warning text-center">La fecha de recepción no se ha cambiado<br></div>'; 
                }
                if(empty($datos['deliver'])){
                    $datos["deliver"]=$datosAnteriores['deliver'];
                    echo '<div class="alert-warning text-center">La fecha de entrega no se ha cambiado<br></div>'; 
                } 
                //echo '<div class="alert-success text-center">Los nuevos datos son: </div>'; print_r($datos); echo '<br>'; 
                echo '____________________<br><br>';
                $respuesta = ModeloFormularios::mdlEditarResultado($tabla, $datos, 'code',$valor); 
                echo '<div class="alert-success text-center">Se han guardado los cambios<br></div>'; 
                echo '<script>if(window.history.replaceState){
                    window.history.replaceState( null, null, window.location.href);
                    setTimeout(function(){location.reload()},1000);}</script>';//setTimeout(function(){location.reload()},1000)
                $dir = 'panel_admin.php?modulos=historial_admin&name='.$datosAnteriores['dr'].'&idt='.$idt;
                //echo $dir;
                echo '<script> window.open("'.$dir.'") </script>';//_________________
            }
            else {
                echo '<script>if(window.history.replaceState){
                    window.history.replaceState( null, null, window.location.href);
                }</script>';
                echo '<div class="alert-danger text-center">No se han modificado los datos <br></div>'; 
            }    
                echo '<script>if(window.history.replaceState){
                    window.history.replaceState( null, null, window.location.href);
                }</script>';
                 
        } 
        echo '<script>if(window.history.replaceState){
            window.history.replaceState( null, null, window.location.href);
        }</script>';
        
    }

    //ESTA CLASE CTRL EDITAR LA INFORMACION DEL USUARIO
    public function ctrUpdate($idt)
    {
        if (isset($_POST['actualizar'])){
            $tabla = "usuarios"; //el mismo nombre que la tabla en MyphpAdmin
            $datos = array(
                "id" => $_POST["id"],
                "name" => $_POST["update_nombre"],
                "specialty" => $_POST["update_especialidad"],
                "home" => $_POST["update_casa"],
                "email" => $_POST["update_email"],
                "phone" => $_POST["update_telf"]);
            
            if ($datos['name']!='admin_cpi' || $datos['id']!=1){
                if(strlen($_POST["update_pass"])>=7){
                    //"password" => $_POST["update_pass"],
                    $datos["password"]=$_POST["update_pass"];
                }
                else{
                    $datos["password"]=$_POST["old_pass"];
                }
                
                $respuesta = ModeloFormularios::mdlEditar($tabla, $datos); 
                    
                if (($respuesta =='ok') ){
                    echo '<div class="alert-success">Actualización de datos exitosa</div>';
                    echo '<script> setTimeout(function(){window.location = "../views/panel_admin.php?modulos=inicio_admin&idt='.$idt.'";},3000)</script>';
                }
                else{
                    echo '<div class="alert-danger">Error en la actualización de datos - problemas con el servidor</div>';
                }    

            }

        
        }
        
    }

    //ESTA CLASE CTRL LLAMA AL MODELO PARA ELIMINAR UN USUARIO
    static public function ctrEliminarUsuario($idt){
        $tabla= "usuarios";
        if(isset($_POST["eliminar"]))
        {
            $resultado = ModeloFormularios::mdlEliminarRegistro($tabla,'id', $_POST["eliminar"]); 
            if ($resultado=="ok"){
                echo '<script>alert("Usuario eliminado")</script>';
                echo '<script> setTimeout(function(){window.location = "../views/panel_admin.php?modulos=inicio_admin&idt='.$idt.'";},1000)</script>';
            }
        }
    }

    //ESTA CLASE CTRL LLAMA AL MODELO PARA ELIMINAR UN USUARIO
    static public function ctrEliminarExamen(){
        if(isset($_POST["eliminar"]))
        {
            //echo '<br>Controlador ok<br>';
                    
            //$codigoBorrar = ModeloFormularios::mdlSpecificValueQuery('resultados','code','code',$_POST['eliminar']);
            $doctor = ModeloFormularios::mdlSpecificValueQuery('resultados','dr','code',$_POST['eliminar']);
            $filename = ModeloFormularios::mdlSpecificValueQuery('resultados','result','code',$_POST['eliminar']);
            
            //echo $doctor['dr'];
            //echo ('<br>Variable post: '.($_POST['eliminar']).'<br>');
            //echo ('<br>Codigo a borrar:  ');
            //print_r($codigoBorrar['code']);
            //print_r($_POST["eliminar"]);
            //echo '<br>';
            if (isset($filename) && isset($doctor)){
                //echo ('<br>Nombre archivo:  ');
                //print_r($filename['result']);
                //echo '<br>';
                //$location = 'http://localhost/cpi_login/views/results/'.$doctor['dr'].'/';
                $location = '../views/results/'.$doctor['dr'].'/';
                $dir=$location.$filename['result'].'.pdf';
                //echo $dir;
                $eliminar = ModeloFormularios::mdlEliminarRegistro('resultados','code',$_POST["eliminar"]); 
                
                if (unlink($dir)){
                    echo '<script>alert("Informe eliminado")</script>';
                    echo '<script> setTimeout(function(){location.reload();},1000)</script>';
                    //echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
                }
                else{
                    echo '<div class="alert-danger text-center">No se haencontrado el documento en la base de datos <br></div>'; 
                    echo '<script> setTimeout(function(){location.reload();},1000)</script>';
                    
                }
            }
            //else{
            //    echo '<script>alert("No existe el documento, registro eliminado")</script>';
            //}
            
            //echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
        //    echo '<script> setTimeout(function(){location.reload();},1000)</script>';
            
            }
            //$eliminar = null;
        //}
        echo '<script>if(window.history.replaceState){window.history.replaceState( null, null, window.location.href);}</script>';
        
    }
    
    //ESTE CTRL HACE UNA CONSULTA DE TODOS LOS DATOS DE LA COLUMNA NAME 
    static public function Autocomplete()
    {
        $tabla = 'usuarios';
        $column = 'name';
        $autolist = ModeloFormularios::mdlColumnReturn($tabla,$column);
        return $autolist;
    }

    //ESTE CTRL  RECIVE EL ARCHIVO Y LO RENOMBRA 
    static public function ctrlSaveFile($filename, $file_tmp, $route){
        move_uploaded_file($file_tmp, $route);
    }


}
