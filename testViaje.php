<?php
include_once "Empresa.php";
include_once "Viaje.php";
include_once "Responsable.php";
include_once "Pasajero.php";
include_once "BaseDatos.php";


$objBaseDatos = new BaseDatos();

/**$objEmpresa = new Empresa();
$objEmpresa->cargar(140, "Koko", "Av.Siempre Viva 123");
$objEmpresa->insertar();

$objResponsable = new Responsable();
$objResponsable->cargar(159, 159852753, "Manuel", "Ortega");
$objResponsable->insertar();

$objViaje =  new Viaje();
$objViaje->cargar(175, "Plottier", 25, 140, 159, 258);
$objViaje->insertar();


$objPasajero = new Pasajero();
$objPasajero->cargar("Enzo", "Riverti", "41911018", 2994270981, 175);
$objPasajero->insertar();*/








/**
     * Módulo para validar una cadena de caracteres que no esté vacía y no contenga números.
     * @param string $cadena La cadena a validar
     * @return string La cadena validada
     */
    function validacionString($cadena) {
        while (empty($cadena) || !preg_match('/^[a-zA-Z ]+$/', $cadena)) {
            echo "ERROR: El valor ingresado no es válido. El valor ingresado no puede contener numeros: ";
            $cadena = trim(fgets(STDIN));
        }
        return $cadena;
    }

    /**
     * modulo para validar numeros enteros positivos
     * @param int $esPositivo
     * @return int
     */
    function validacionEnteroPositivo($esPositivo){
        while($esPositivo <= 0 || !ctype_digit($esPositivo)){
            echo "ERROR:la cantidad no puede ser menor o igual 0 y tiene que ser un numero entero.Ingrese una cantidad valida: ";
            $esPositivo = trim(fgets(STDIN));
        }
        return $esPositivo;
    }

    /**
     * Módulo que muestra un menú y pide una opción por teclado.
     * @return int La opción seleccionada.
     */
    function opcionesMenu(){
        echo "\n----------MENU----------\n
        1) Cargar información\n
        2) Modificar información\n
        3) Eliminar información\n
        4) Mostrar datos\n
        5) Salir\n";
        $respuestaMenu = trim(fgets(STDIN));
        while($respuestaMenu < 1 || $respuestaMenu > 5 || !ctype_digit($respuestaMenu)){
            echo "Error: seleccione una opción válida (1-4): ";
            $respuestaMenu = trim(fgets(STDIN));
        }
        return intval($respuestaMenu);
    }


    
    /**
     * modulo que valida y crea un array de objetos Pasajero
     * @param int $cantidadMaxima
     * @return array
     */
    function datosPasajeros(){
            $objViaje = new Viaje();
            $objPasajero = new Pasajero();
            $colViaje = $objViaje->listar();
            $strinViaje = arrayString($colViaje);
            echo "\n" . $strinViaje . "\n";
            
            $idViaje = readline("Ingrese el id del viaje: ");
            $idViaje = validacionEnteroPositivo($idViaje);

            if($objViaje->buscar($idViaje)){
            
            $dni = readline("Ingrese el numero de documento del pasajero: ");
            $dni = validacionEnteroPositivo($dni);

            if($objPasajero->buscar($dni)){
                echo "No se puede cargar el pasajero porque ya existe";
            }else{

            $nombre = readline("Ingrese el nombre del pasajero: ");
            $nombre = validacionString($nombre);
            $apellido = readline("Ingrese el apellido del pasajero: ");
            $apellido = validacionString($apellido);
            
            echo "Ingrese el numero de telefono: ";
            $telefono = trim(fgets(STDIN));
            $telefono = validacionEnteroPositivo($telefono);
            
            
            
            $objPasajero->cargar($nombre, $apellido, $dni, $telefono, $objViaje);
            $objPasajero->insertar();
            
        
       
        }
    }else{
        echo "El id del viaje no existe. Pruebe con otro.";
    }
}
   
    /**
     * modulo que valida y crea un objeto Responsable
     * @param int 
     * @return Responsable
     */
    function cargarResponsable(){
            $objResponsable = new Responsable();
            $colResponsable = $objResponsable->Listar(); 
            echo "Ingrese el numero de licencia: ";
            $nroLicencia = trim(fgets(STDIN));
            $nroLicencia = validacionEnteroPositivo($nroLicencia);
            $i = 0;
            $licencia = null;
            while($i < count($colResponsable) && $licencia != $nroLicencia){
                $licencia = $colResponsable[$i]->getNroLicencia();
                $i += 1;
            }
            if($licencia != $nroLicencia){
            $nroEmpleado = null;
            $nombre = readline("Ingrese el nombre del responsable: ");
            $nombre = validacionString($nombre);
            $apellido = readline("Ingrese el apellido del responsable: ");
            $apellido = validacionString($apellido);
            $objResponsable->cargar($nroEmpleado, $nroLicencia, $nombre, $apellido);
            $objResponsable->insertar();
            
        
        return $objResponsable;
        }else{
            echo "El numero de licencia ya existe pruebe con otro \n";
        }
            
        }
    

    /**
     * modulo que valida y crea un objeto Empresa
     * @param  
     * @return Empresa
     */
    function cargarEmpresa(){
        $objEmpresa = new Empresa();
        $resp = $objEmpresa->buscar(1);

        if(!$resp){
        $idEmpresa = null;
        $nombre = readline("Ingrese el nombre de la empresa: ");
        $nombre = validacionString($nombre);
        $direccion = readline("Ingrese la dirección de la empresa: ");
        $direccion = validacionString($direccion);
    
        
        $objEmpresa->cargar($idEmpresa, $nombre, $direccion);
        $objEmpresa->insertar();
    
        return $objEmpresa;
        }else{
            echo "Ya existe una empresa. Elimine esta misma para poder crear otra" . "\n" ;
        }
    }

    function arrayString($array){
            $cadena = ""; 
             

            for($i=0 ; $i<count($array) ; $i++) {
                $cadena .= $array[$i] . $i . "\n";
            }    
            return $cadena ; 
    }

/**
     * modulo que valida y crea un objeto Responsable
     * @param  
     * @return Viaje
     */
    function cargarViaje(){
        $objEmpresa = new Empresa();
        $objResponsable = new Responsable();
        $colEmpresa = $objEmpresa->listar();
        $colResponsable = $objResponsable->listar();
        $stringResponsable = arrayString($colResponsable);
        $stringEmpresa = arrayString($colEmpresa);
        echo "\n" . $stringEmpresa;
        $idEmpresa = readline("Ingrese el id de la empresa: ");
        $idEmpresa = validacionEnteroPositivo($idEmpresa);
        
        
        
        if($objEmpresa->buscar($idEmpresa)){
            echo "\n" . $stringResponsable;
            $nroEmpleado = readline("Ingrese el numero de empleado: ");
            $nroEmpleado = validacionEnteroPositivo($nroEmpleado);
            
            
            
            
            if($objResponsable->buscar($nroEmpleado)){
                $destino = readline("Ingrese el destino del pasajero: ");
                $destino = validacionString($destino);
                $cantMax = readline("Ingrese la cantidad maxima de pasajeros: ");
                $cantMax = validacionEnteroPositivo($cantMax);
                
                
                $importe = readline("Ingrese el importe: ");
                $importe = validacionEnteroPositivo($importe);
                $idViaje = null;
                
                
                $objViaje = new Viaje();
                $objViaje->cargar($idViaje, $destino, $cantMax, $objEmpresa, $objResponsable, $importe);
                $objViaje->insertar();
                
                
            
            
            }else{
                echo "El numero de empleado no existe. Prueba de vuelta con otro" . "\n";
            }
        }else{
            echo "Id no existe. Prueba de vuelta con otro" . "\n";
        }
        
        
}


function cargarColPasajeros($objViaje){
    $cantMax = $objViaje->getCantMax();
    $pasajeros = datosPasajeros($cantMax);
    $objViaje->setPasajeros($pasajeros);
}

function modificarEmpresa(){
    $objEmpresa = new Empresa();
    

    
    $idEmpresa = 1;
    $nombre = readline("Ingrese el nombre de la empresa: ");
    $nombre = validacionString($nombre);
    $direccion = readline("Ingrese la dirección de la empresa: ");
    $direccion = validacionString($direccion);

    
    $objEmpresa->cargar($idEmpresa, $nombre, $direccion);
    $objEmpresa->modificar();

    return $objEmpresa;
    
}

    function modificarResponosable(){
                $objResponsable = new Responsable();
                $colResponsable = $objResponsable->listar();
                $stringResponsables = arrayString($colResponsable);
                echo "\n" . $stringResponsables;
                echo "\n" . "Ingrese el numero de empleado del responsable que desea modificar: "; 
                $nroEmpleado = trim(fgets(STDIN));
               
                if($objResponsable->buscar($nroEmpleado)){
                echo "Ingrese el numero de licencia: ";
                $nroLicencia = trim(fgets(STDIN));
                $nroLicencia = validacionEnteroPositivo($nroLicencia);
                $i = 0;
                $licencia = null;
                while($i < count($colResponsable) && $licencia != $nroLicencia){
                    $licencia = $colResponsable[$i]->getNroLicencia();
                    $i += 1;
                }
                if($licencia != $nroLicencia){
                
                $nombre = readline("Ingrese el nombre del responsable: ");
                $nombre = validacionString($nombre);
                $apellido = readline("Ingrese el apellido del responsable: ");
                $apellido = validacionString($apellido);
                $objResponsable->cargar($nroEmpleado, $nroLicencia, $nombre, $apellido);
                $objResponsable->modificar();
                

            return $objResponsable;
            }else{
                echo "El numero de licencia ya existe pruebe con otro \n";
            }
        }else{
            echo "El numero de empleado ingresado no existe.";
        }
        }


    function modificarViaje(){
        $objEmpresa = new Empresa();
        $objResponsable = new Responsable();
        $objViaje = new Viaje();
        $colViaje = $objViaje->listar();
        $strinViaje = arrayString($colViaje);
        echo "\n" . $strinViaje;
        echo "\n" . "Que ingrese el id del viaje que desea modificar: ";
        $idViaje = trim(fgets(STDIN));

        if($objViaje->buscar($idViaje)){
        $idEmpresa = readline("Ingrese el id de la empresa: ");
        $idEmpresa = validacionEnteroPositivo($idEmpresa);
        if($objEmpresa->buscar($idEmpresa)){
        
            $nroEmpleado = readline("Ingrese el numero de empleado: ");
            $nroEmpleado = validacionEnteroPositivo($nroEmpleado);
        
        if($objResponsable->buscar($nroEmpleado)){
            $destino = readline("Ingrese el destino del pasajero: ");
            $destino = validacionString($destino);
            $cantMax = readline("Ingrese la cantidad maxima de pasajeros: ");
            $cantMax = validacionEnteroPositivo($cantMax);
            
            
            $importe = readline("Ingrese el importe: ");
            $importe = validacionEnteroPositivo($importe);
            
            
            
            
            $objViaje->cargar($idViaje, $destino, $cantMax, $objEmpresa, $objResponsable, $importe);
            $objViaje->modificar();
            
            
        
        
        }else{
            echo "El numero de empleado no existe. Prueba de vuelta con otro" . "\n";
        }
    }else{
        echo "Id no existe. Prueba de vuelta con otro" . "\n";
    }
    
    }else{
        echo "Id no existe. Prueba de vuelta con otro" . "\n";
    }
}

function modficiarPasajero(){
            $objViaje = new Viaje();
            $objPasajero = new Pasajero();
            
            $colPasajero = $objPasajero->listar();
            $strinPasajero = arrayString($colPasajero);
            echo "\n" . $strinPasajero . "\n Lo unico NO de modificable del pasajero es el DNI. Para cambiarlo debera eliminar el pasajero y volver a ingresarlo \n";
            echo "\n" . "Ingrese el DNI del pasajero que desea modificar: ";
            $dni = trim(fgets(STDIN));
            $dni = validacionEnteroPositivo($dni);
        if($objPasajero->buscar($dni)){
            
            $idViaje = readline("Ingrese el id del viaje: ");
            $idViaje = validacionEnteroPositivo($idViaje);
            
            if($objViaje->buscar($idViaje)){
            $nombre = readline("Ingrese el nombre del pasajero: ");
            $nombre = validacionString($nombre);
            $apellido = readline("Ingrese el apellido del pasajero: ");
            $apellido = validacionString($apellido);
            
            echo "Ingrese el numero de telefono: ";
            $telefono = trim(fgets(STDIN));
            $telefono = validacionEnteroPositivo($telefono);
            
            
            
            $objPasajero->cargar($nombre, $apellido, $dni, $telefono, $objViaje);
            $objPasajero->modificar();
            
        
       
        
        }else{
        echo "El id del viaje no existe. Pruebe con otro.";
        }
    }else{
        echo "El DNI ingresado no existe.";
    }
}

function eliminarPasajero(){
    
            $objPasajero = new Pasajero();
            
            $colPasajero = $objPasajero->listar();
            $strinPasajero = arrayString($colPasajero);
            echo $strinPasajero;
            echo "\n" . "Ingrese el DNI del pasajero que desea eliminar: ";
            $dni = trim(fgets(STDIN));
            $dni = validacionEnteroPositivo($dni);
            if($objPasajero->buscar($dni)){
                $objPasajero->eliminar();
                echo "Pasajero eliminado. \n";
            }else{
                echo "El DNI ingresado no existe. \n";
            }
}

function eliminarViaje(){

            echo "-----AVERTENCIA----- \n SI ELIMINA UN VIAJE TAMBIEN ELIMINA TODOS LOS PASAJEROS DE ESE VIAJE \n";
            echo "\nDesea continuar: ";
            $resp = trim(fgets(STDIN));
            $resp = validacionString($resp);
            if($resp == "Si" || $resp == "si"){

            $objViaje = new Viaje();
            $objPasajero = new Pasajero();
            $colPasajeros = $objPasajero->listar();
            
            $colViaje = $objViaje->listar();
            $stringViaje = arrayString($colViaje);
            echo $stringViaje;
            echo "\n" . "Ingrese el id del viaje que desea eliminar: ";
            $idViaje = trim(fgets(STDIN));
            $idViaje = validacionEnteroPositivo($idViaje);
            $pasaIdViaje = 0;
            if(!empty($colPasajeros)){
                for($i = 0;$i < count($colPasajeros);$i++){
                    $pasaIdViaje = $colPasajeros[$i]->getObjViaje();
                    if($idViaje == $pasaIdViaje){
                        $dni = $colPasajeros[$i]->getNroDni();
                        $objPasajero->buscar($dni);
                        $objPasajero->eliminar();
                    }
                    
                }
            }

            
            if($objViaje->buscar($idViaje)){
                
                $objViaje->eliminar();
                echo "Viaje eliminado. \n";
            }else{
                echo "El id ingresado no existe. \n";
            }
       
        
        }
}

function eliminarResponsable(){
    echo "-----AVERTENCIA----- \n SI ELIMINA UN REPONSABLE TAMBIEN ELIMINA TODOS LOS VIAJES DE ESE RESPONSABLE Y POR ENDE TAMBIEN LOS PASAJEROS \n";
            echo "\nDesea continuar: ";
            $resp = trim(fgets(STDIN));
            $resp = validacionString($resp);
            if($resp == "Si" || $resp == "si"){
                $objViaje = new Viaje();
                $objResponsable = new Responsable();
                $objPasajero = new Pasajero();
                $colPasajeros = $objPasajero->listar();
                $colResponsable = $objResponsable->listar();
                $colViaje = $objViaje->listar();
                $stringResponsable = arrayString($colResponsable);
                echo $stringResponsable;
                echo "\n" . "Ingrese el numero del empleado que desea eliminar: ";
                $nroEmpleado = trim(fgets(STDIN));
                $nroEmpleado = validacionEnteroPositivo($nroEmpleado);
                $idViajePasajero = 0;
                $idViaje = 0;
                $pasajero = null;
                $viaje = null;
                $nroEmpleadoViaje = null;

                if($objResponsable->buscar($nroEmpleado)){
                for($i = 0;$i < count($colPasajeros); $i++){
                    $pasajero = $colPasajeros[$i];
                    $idViajePasajero = $pasajero->getObjViaje();
                    $viaje = $colViaje[$i];
                    $idViaje = $viaje->getIdViaje();
                    $nroEmpleadoViaje = $viaje->getResponsable();
                    if($nroEmpleado == $nroEmpleadoViaje){
                        if($idViaje == $idViajePasajero){
                            $pasajero->eliminar();
                        }
                    }
                }

                
                    $objResponsable->eliminar();
                    echo "Responsable eliminado. \n";
                }else{
                    echo "El numero ingresado no existe. \n";
                }
        }
}

function eliminarEmpresa(){
    echo "-----AVERTENCIA----- \n SI ELIMINA LA EMPRESA ELIMINA TODOS LOS DATOS(PASAJEROS,VIAJES Y RESPONSABLES) \n";
    echo "\nDesea continuar: ";
    $resp = trim(fgets(STDIN));
    $resp = validacionString($resp);
    if($resp == "Si" || $resp == "si"){
        $objEmpresa = new Empresa();
        $objResponsable = new Responsable();
        $objViaje = new Viaje();
        $objPasajero = new Pasajero();
        $colResponsable = $objResponsable->listar();
        $colViaje = $objViaje->listar();
        $colPasajero = $objPasajero->listar();
        $pasajero = 0;
        $viaje = 0;
        $responsable = 0;
        for($i=0;$i<count($colPasajero);$i++){
            $pasajero = $colPasajero[$i];
            $pasajero->eliminar();
        }
        for($i=0;$i<count($colViaje);$i++){
            $viaje = $colViaje[$i];
            $viaje->eliminar();
        }
        for($i=0;$i<count($colResponsable);$i++){
            $responsable = $colResponsable[$i];
            $responsable->eliminar();
        }

        $objEmpresa->buscar(1);
        $objEmpresa->eliminar();

    }
}

function mostrarEmpresa(){
    $objEmpresa = new Empresa();
    $colEmpresa = $objEmpresa->listar();
    $string = arrayString($colEmpresa);
    echo "\n" . $string;
}
function mostrarResponsable(){
    $objResponsable = new Responsable();
    $colResponsable = $objResponsable->listar();
    $string = arrayString($colResponsable);
    echo "\n" . $string;
}
function mostrarViaje(){
    $objViaje = new Viaje();
    $colViaje = $objViaje->listar();
    $string = arrayString($colViaje);
    echo "\n" . $string;
}
function mostrarPasajero(){
    $objPasajero = new Pasajero();
    $colPasajero = $objPasajero->listar();
    $string = arrayString($colPasajero);
    echo "\n" . $string;
}

/**
 * Funcion que le solicita al usuario un numero dentro de un rango
 * @param int $min , $max
 * @return int
 */
function ingresarMinMax($min , $max){
    
    echo "Ingrese un numero entre " . $min . " y " . $max . ": ";
    $numeroSolicit = trim(fgets(STDIN));
    $numeroSolicit = validacionEnteroPositivo($numeroSolicit);
    while($numeroSolicit < $min || $numeroSolicit > $max){
      echo "Ingrese un numero entre " . $min . " y " . $max . ": ";
      $numeroSolicit = trim(fgets(STDIN));
    }
    $numeroSolicit =(int) $numeroSolicit/1;
    return $numeroSolicit;
  }

  function menuIngresar(){
    echo  "\n" ."1)Empresa\n2)Responsable\n3)Viaje\n4)Pasajero" . "\n";
    $cargar = ingresarMinMax(1,4);
    if($cargar == 1){
        cargarEmpresa();
    }if($cargar == 2){
        cargarResponsable();
    }
    if($cargar == 3){
        
        cargarViaje();
    }
    if($cargar == 4){
        $objPasajero = datosPasajeros();
        if($objPasajero instanceof Pasajero){
            $pasajeros = $objViaje->getPasajeros();
            array_push($pasajeros,$objPasajero);
            $objViaje->setPasajeros($pasajeros);
        }
    }
  }

  function menuModificar(){
    echo  "\n" ."1)Empresa\n2)Responsable\n3)Viaje\n4)Pasajero" . "\n";
    $modificar = ingresarMinMax(1,4);
    if($modificar == 1){
            modificarEmpresa();
    }if($modificar == 2){
        modificarResponosable();
    }
    if($modificar == 3){
        
        modificarViaje();
    }
    if($modificar == 4){
        $objPasajero = modficiarPasajero();
        if($objPasajero instanceof Pasajero){
            $pasajeros = $objViaje->getPasajeros();
            array_push($pasajeros,$objPasajero);
            $objViaje->setPasajeros($pasajeros);
        }
    }
  }
  function menuEliminar(){
    echo  "\n" ."1)Empresa\n2)Responsable\n3)Viaje\n4)Pasajero" . "\n";
    $eliminar = ingresarMinMax(1,4);
    if($eliminar == 1){
        eliminarEmpresa();
    }if($eliminar == 2){
        eliminarResponsable();
    }
    if($eliminar == 3){
        eliminarViaje();
    }
    if($eliminar == 4){
        eliminarPasajero();
    }
  }

  function menuMostrar(){
    echo  "\n" . "1)Empresa\n2)Responsable\n3)Viaje\n4)Pasajero" . "\n";
    $mostrar = ingresarMinMax(1,4);
    if($mostrar == 1){
        mostrarEmpresa();
    }if($mostrar == 2){
        mostrarResponsable();
    }
    if($mostrar == 3){
        mostrarViaje();
    }
    if($mostrar == 4){
        mostrarPasajero();
    }
  }


//menu

$respuesta = opcionesMenu();
    $objEmpresa = new Empresa();
    $objResponsable = new Responsable();
    $objViaje = new Viaje();
    $objPasajero = new Pasajero();
    
while($respuesta >= 1 && $respuesta <=5){
    if($respuesta == 1){
        menuIngresar();
    }elseif($respuesta == 2){
        menuModificar();
    }elseif($respuesta==3){
        menuEliminar();
    }elseif($respuesta==4){
        menuMostrar();
    }elseif($respuesta==5){
        
        exit("Programa finalizado");
    }
    $respuesta = opcionesMenu();
}

