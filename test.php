<?php

    include_once "Viaje.php";
    include_once "Pasajero.php"; 
    include_once "Responsable.php";
    include_once "PasajeroVip.php";
    include_once "PasajeroConNecesidad.php";
    /**
     * Módulo que muestra un menú y pide una opción por teclado.
     * @return int La opción seleccionada.
     */
    function opcionesMenu(){
        echo "----------MENU----------\n1) Cargar información\n2) Modificar información\n3) Ver datos del viaje\n4) Salir\n";
        $respuestaMenu = trim(fgets(STDIN));
        while($respuestaMenu < 1 || $respuestaMenu > 4 || !ctype_digit($respuestaMenu)){
            echo "Error: seleccione una opción válida (1-4): ";
            $respuestaMenu = trim(fgets(STDIN));
        }
        return intval($respuestaMenu);
    }

    /**
     * Módulo para validar una cadena de caracteres que no esté vacía y no contenga números.
     * @param string $cadena La cadena a validar
     * @return string La cadena validada
     */
    function validacionString($cadena) {
        while (empty($cadena) || !preg_match('/^[a-zA-Z ]+$/', $cadena)) {
            echo "ERROR: El valor ingresado no es válido. Ingrese un valor alfanumérico: ";
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
     * modulo que valida y guarda el destino del viaje
     * @param
     * @return string
     */
    function cargarDestino(){
        echo "Ingrese destino: ";
        $destino = trim(fgets(STDIN));
        $destino = validacionString($destino);
        return $destino;
    }

    /**
     * modulo que valida y guarda la cant maxima de pasajeros
     * @param
     * @return int
     */
    function cantMaximaPasajeros(){
        echo "Cantidad maxima de pasajeros: ";
        $cantMax = trim(fgets(STDIN));
        $cantMax = validacionEnteroPositivo($cantMax);

        return $cantMax;
    }

    /**
     * modulo que valida y crea un array de objetos Pasajero
     * @param int $cantidadMaxima
     * @return array
     */
    function datosPasajeros($cantidadMaxima){
        $pasajeros = array();
        $nroPasajero = 0;
        echo "Cuantos pasajeros va ingresar: ";
        $cantPasajeros = trim(fgets(STDIN));
        $cantPasajeros = validacionEnteroPositivo($cantPasajeros);
        while($cantPasajeros > $cantidadMaxima){
            echo "La cantidad de pasajeros no puede ser mayor a la cantidad maxima del viaje. Ingrese una cantidad valida: ";
            $cantPasajeros = trim(fgets(STDIN));
        }
        for($i = 1;$i <= $cantPasajeros;$i++){
            $nombre = readline("Ingrese el nombre del pasajero: ");
            $nombre = validacionString($nombre);
            $apellido = readline("Ingrese el apellido del pasajero: ");
            $apellido = validacionString($apellido);
            $dni = readline("Ingrese el numero de documento del pasajero: ");
            $dni = validacionEnteroPositivo($dni);
            echo "Ingrese el numero de telefono: ";
            $telefono = trim(fgets(STDIN));
            $telefono = validacionEnteroPositivo($telefono);
            $nroPasajero = $nroPasajero + 1;
            $objPasajero = new Pasajero($nombre, $apellido, $dni, $telefono, $nroPasajero);
            array_push($pasajeros, $objPasajero);
        }
        return $pasajeros;
    }

    /**
     * Modulo que valida los datos del responsable y crea el nuevo objeto
     * @return array
     */
    function crearResponsable(){
         echo "Ingrese el numero de empleado: ";
        $nroEmpleado = trim(fgets(STDIN));
        $nroEmpleado = validacionEnteroPositivo($nroEmpleado);
         echo "Ingrese el nuemro de licencia: ";
        $nroLicencia = trim(fgets(STDIN));
        $nroLicencia = validacionEnteroPositivo($nroLicencia);
        echo "Ingrese el nombre del empleado: ";
        $nombreEmpleado = trim(fgets(STDIN));
        $nombreEmpleado = validacionString($nombreEmpleado);
        echo "Ingrese el apellido del empleado: ";
        $apellidoEmpleado = trim(fgets(STDIN));
        $apellidoEmpleado = validacionString($apellidoEmpleado);
        $objResponsable = new Responsable($nroEmpleado, $nroLicencia, $nombreEmpleado, $apellidoEmpleado);

        return $objResponsable;
    }


    /**
     * Modulo que setea el nuevo codigo
     * @param Viaje $viaje
     * @return Viaje
     */
    function cambiarCod($viaje){
        $newCodigo = readline("Ingrese el nuevo codigo: ");
        $viaje->setCodigo($newCodigo);
        return $viaje;
    }

    /**
     * Modulo que setea el nuevo destino
     * @param Viaje $viaje
     * @return Viaje
     */

    function cambiarDest($viaje){
        $newDestino = readline("Ingresar el nuevo destino: ");
        $newDestino = validacionString($newDestino);
        $viaje->setDestino($newDestino);
        return $viaje;
    }

    /**
     * Modulo que setea la nueva cantMax
     * @param Viaje $viaje
     * @return Viaje
     */
    function cambiarCantMax($viaje, $cantPasajeros){
        $newCantMax = readline("Ingresar la nueva cantidad maxima de pasajeros: ");
        $newCantMax = validacionEnteroPositivo($newCantMax);
        while($newCantMax < $cantPasajeros){
            echo "Error:La nueva cantidad maxima no puede ser menor a la cantidad de pasajeros existentes.\n";
            $newCantMax = readline("Ingresar la nueva cantidad maxima de pasajeros: ");
            $newCantMax = validacionEnteroPositivo($newCantMax);
        }
        $viaje->setCantMax($newCantMax);
        return $viaje;
    }
    /**
     * Modulo que setea al responsable
     * @param Responsable $objResponsable
     * @return Responsable
     */

    function cambiarResponsable($objResponsable){
        $newNroEmpleado = redline("Ingrese el numero de empleado: ");
        $newNroEmpleado = validacionEnteroPositivo($newNroEmpleado);
        $objResponsable->setNroEmpleado($newNroEmpleado);

        $newNroLicencia = redline("Ingrese el numero de licencia: ");
        $newNroLicencia = validacionEnteroPositivo($newNroLicencia);
        $objResponsable->setNroLicencia($newNroLicencia);

        $newNombreEmpleado = redline("Ingrese el nombre del empleado: ");
        $newNombreEmpleado = validacionString($newNombreEmpleado);
        $objResponsable->setNombre($newNombreEmpleado);

        $newApellidoEmpleado = redline("Ingrese el apellido del empleado: ");
        $newApellidoEmpleado = validacionString($newApellidoEmpleado);
        $objResponsable->setApellido($newApellidoEmpleado);

        return $objResponsable;
    }

    function menuSet(){
        echo "1.Codigo" . "\n" . "2.Destino " . "\n" . "3.Cantidad max de pasajeros" . "\n" . "4.Pasajeros" .  "\n" . "5.Responsable" .  "\n" . "Que desea cambiar: ";
        $respuestaSet = trim(fgets(STDIN));
        $respuestaSet = validacionEnteroPositivo($respuestaSet);
        while($respuestaSet < 1 || $respuestaSet > 4){
            "Error: tiene que ser una de las opciones validas: ";
            $respuestaSet = trim(fgets(STDIN));
            $respuestaSet = validacionEnteroPositivo($respuestaSet);
        }
        return $respuestaSet;
    }


    //programa principal


    $respuestaDelMenu = opcionesMenu();
    while($respuestaDelMenu >= 1 && $respuestaDelMenu <= 4){
        if($respuestaDelMenu == 1){
        echo "Ingrese el codigo del viaje: ";
        $codigo = trim(fgets(STDIN));
        $destiny = cargarDestino();
        $cantMaxima = cantMaximaPasajeros();
        $arregloPasajeros = datosPasajeros($cantMaxima);
        $responsable = crearResponsable();
        $objViaje = new Viaje($codigo, $destiny, $cantMaxima, $arregloPasajeros, $responsable);
    }elseif($respuestaDelMenu == 2){
        $deseaSetear = menuSet();
        if($deseaSetear == 1){
            $objViaje = cambiarCod($objViaje);
        }elseif($deseaSetear == 2){
            $objViaje = cambiarDest($objViaje);
        }elseif($deseaSetear == 3){
            $countDePasajeros = count($arregloPasajeros);
            $objViaje = cambiarCantMax($objViaje, $countDePasajeros);
        }elseif($deseaSetear == 4){
            $opcion = readline("(1)Desea ingresar todos los pasajeros de 0 , (2) desea cambiar un pasajero o (3) agregar un pasajero: ");
            $opcion = validacionEnteroPositivo($opcion);
            while($opcion != 1 && $opcion != 2 && $opcion != 3){
                $opcion = readline("ERROR:Debe ingresar (1) para ingresar todos los pasajeros, (2) para cambiar uno solo (3) agregar un pasajero: ");
            }
            if($opcion == 1){
            $arregloPasajeros = pasajerosDeCero($objViaje, $countDePasajeros);
            $objViaje->setPasajeros($arregloPasajeros);
            }elseif($opcion == 2){
                echo $objViaje;
                $indicePasajero = redline("Que nro de pasajero desea cambiar: ");
                $indicePasajero = $indicePasajero - 1;
                while($indicePasajero < 0 || $indicePasajero > count($arrayPasajeros)){
                    $indicePasajero = readline("ERROR:ingrese un indice valido: ");
                }
                $nuevoPasajero = cambiarPasajero();
                $objPasajero->cambiarUnPasajero($indicePasajero, $nuevoPasajero);
            }elseif($opcion == 3){
                $nuevoPasajero = cambiarPasajero();
                $objPasajero->agregarPasajero($nuevoPasajero);
            }
        }elseif($deseaSetear == 5){
            $objResponsable = cambiarResponsable($objResponsable);
            $objViaje->setResponsable($objResponsable);
        }
    }elseif($respuestaDelMenu == 3){
        echo $objViaje . "\n";
    }else{
        echo "Programa Finalizado";
    }
    $respuestaDelMenu = opcionesMenu();
    }

    /**
     * Modulo que setea a todos los pasajeros de 0
     * @param Viaje $viaje
     * @param int $cantidadMaxima
     * @return array
     */

    function pasajerosDeCero($viaje, $cantidadMaxima){
            $arrayPasajeros = $viaje->getPasajeros();
            $nroPasajero = 0;
            $newPasajero = array();
            $cantPasajeros = redline("Cuantos pasajeros desea ingresar: ");
            while($cantPasajeros > $cantidadMaxima){
                $cantPasajeros = redline("La cantidad de pasajeros no puede ser mayor a la cantidad maxima del viaje. Ingrese una cantidad valida: ");
            }
            for($i = 1; $i <= $cantPasajeros;$i++){
                $nombre = readline("Ingrese el nombre del pasajero: ");
                $nombre = validacionString($nombre);
                $apellido = readline("Ingrese el apellido del pasajero: ");
                $apellido = validacionString($apellido);
                $dni = readline("Ingrese el numero de documento del pasajero: ");
                $dni = validacionEnteroPositivo($dni);
                $telefono = redline("Ingrese el numero de telefono: ");
                $telefono = validacionEnteroPositivo($telefono);
                $nroPasajero = $nroPasajero + 1;
                $objPasajero = new Pasajero($nombre, $apellido, $dni, $telefono, $nroPasajero);
                array_push($pasajeros, $objPasajero);
            }
        return $pasajeros;
        
    }
 /**
  * Cambia un Pasajero
  * @return Pasajero
  */
    function cambiarPasajero(){
            $nombre = readline("Ingrese el nombre del pasajero: ");
            $nombre = validacionString($nombre);
            $apellido = readline("Ingrese el apellido del pasajero: ");
            $apellido = validacionString($apellido);
            $dni = readline("Ingrese el numero de documento del pasajero: ");
            $dni = validacionEnteroPositivo($dni);
            $telefono = redline("Ingrese el numero de telefono: ");
            $telefono = validacionEnteroPositivo($telefono);
            $nroPasajero = $nroPasajero + 1;
            $objPasajero = new Pasajero($nombre, $apellido, $dni, $telefono, $nroPasajero);
        return $objPasajero;
    }