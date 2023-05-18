<?php
class Viaje{
    //Atributos
    private $codigo;
    private $destino;
    private $cantMax;
    private $pasajeros;
    private $responsable;
    private $costoViaje;
    private $totalAbonado;
    //METODOS
    public function __construct($codigoP, $destinoP, $cantMaxP,$newPasajeros, $newResponsable, $costoViaje, $totalAbonado){
        $this->codigo = $codigoP;
        $this->destino = $destinoP;
        $this->cantMax = $cantMaxP;
        $this->pasajeros = $newPasajeros;
        $this->responsable = $newResponsable;
        $this->costoViaje = $costoViaje;
        $this->totalAbonado = $totalAbonado;
    }
    //Get y set de los atributos
    //Retorna valor codigo
    public function getCodigo(){
        return $this->codigo;
    }
    //Setea el codigo
    public function setCodigo($codigoP){
        $this->codigo = $codigoP;
    }
    //Retorna valor destino
    public function getDestino(){
        return $this->destino;
    }
    //setea el el destino
    public function setDestino($destinoP){
        $this->destino = $destinoP;
    }
    //Retorna valor cantidad maxima de pasajeros
    public function getCantMax(){
        return $this->cantMax;
    }
    //setea la cantidad max de pasajeros
    public function setCantMax($cantMaxP){
        $this->cantMax = $cantMaxP;
    }
    //Retorna los datos de los pasajeros 
    public function getPasajeros(){
        return $this->pasajeros;
    }
    //Setea la informacion de los pasajeros
    public function setPasajeros($pasajerosP){
        $this->pasajeros = $pasajerosP;
    }
    public function getResponsable(){
        return $this->responsable;
    }
    public function setResponsable($newResponsable){
        $this->responsable = $newResponsable;
    }
    public function getCostoViaje(){
        return $this->costoViaje;
    }
    public function setCostoViaje($costoViaje){
        $this->costoViaje = $costoViaje;
    }
    public function getTotalAbonado(){
        return $this->totalAbonado;
    }
    public function setTotalAbonado($totalAbonado){
        $this->totalAbonado = $totalAbonado;
    }
    
    //Muestra por pantalla
    public function __toString(){
        return ("Datos del viaje: " . 
        "\n" . "Codigo: " . $this->getCodigo() . 
        "\n" . "Destino: " . $this->getDestino() . 
        "\n" . "Cantidad maxima de pasajeros: " . $this->getCantMax() . 
        "\n" . "Informacion del pasajero: " . "\n" . $this->cadenaPasajeros() . 
        "\n" . "Responsable: " . $this->getResponsable() . 
        "\n" . "Costo del viaje: " . $this->getCostoViaje() . 
        "\n" . "Total Abonado: " . $this->getTotalAbonado() . "\n");
    } 
    //Metodo para cambiar el dato segun el indice 
    public function nuevoDato($indicePasajero, $clave, $datoNuevo){
        $this->pasajeros[$indicePasajero][$clave] = $datoNuevo;
    }
    

    /**
         * Crea una cadena de caracteres con los datos de los pasajeros
         * @return array
         */
        public function cadenaPasajeros() {
            // 

            $cadena = ""; 
            $coleccPasajeros = $this->getPasajeros(); 

            for($i=0 ; $i<count($coleccPasajeros) ; $i++) {
                $cadena .= $coleccPasajeros[$i];
            }    
            return $cadena ; 
        }   
    
        public function cambiarUnPasajero($indicePasajero, $nuevoPasajero){
            $this->pasajeros[$indicePasajero] = $nuevoPasajero;
        }

        public function agregarPasajero($newPasajero){
           array_push($this->pasajeros, $newPasajero);
        }

        public function venderPasaje($objPasajero){
            $coleccPasajeros = $this->getPasajeros();
            $cantPasajeros = count($coleccPasajeros);
            $cantMax = $this->getCantMax();
            $costoViaje = $this->getCostoViaje();
            $totalAbonado = $this->getTotalAbonado();
            $costoFinal = 0;
            if($cantPasajeros >= $cantMax){
                $costoFinal = "Cantidad maxima del viaje alcanzada";
            }else{
                array_push($coleccPasajeros, $objPasajero);
                $this->setPasajeros($coleccPasajeros);
                $porcentaje = 1+($objPasajero->darPorcentajeIncremento()/100);
                $costoFinal = $costoViaje * $porcentaje;
                $totalAbonado += $costoFinal;
                $this->setTotalAbonado($totalAbonado);
            }
            return $costoFinal;
        }


        public function hayPasajesDisponible(){
            $coleccPasajeros = $this->getPasajeros();
            $cantPasajeros = count($coleccPasajeros);
            $cantMax = $this->getCantMax();
            $disponible = false;
            if($cantPasajeros < $cantMax){
                $disponible = true;
            }
            return $disponible;
        }
        
}

//venderPasaje($objPasajero) que debe incorporar el pasajero a la colección de pasajeros ( solo si hay espacio disponible), actualizar los costos abonados y retornar el costo final que deberá ser abonado por el pasajero.