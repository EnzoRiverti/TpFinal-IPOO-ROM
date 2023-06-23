<?php
class Viaje{
    //Atributos
    private $idViaje;
    private $destino;
    private $cantMax;
    private $empresa;
    private $responsable;
    private $importe;
    private $pasajeros;
    private $idEmpresa;
    private $mensajeoperacion;
    //METODOS
    public function __construct(){
        $this->idViaje = "";
        $this->destino = "";
        $this->cantMax = "";
        $this->empresa = "";
        $this->responsable = "";
        $this->importe = "";
        $this->pasajeros = array();
        $this->idEmpresa = "";
        
    }

    public function cargar($idViaje, $destino, $cantMax, $empresa, $responsable, $importe){		
		$this->setIdViaje($idViaje);
		$this->setDestino($destino);
		$this->setCantMax($cantMax);
		$this->setEmpresa($empresa);
        $this->setResponsable($responsable);
        $this->setImporte($importe);
        
    }



    //Get y set de los atributos
    //Retorna valor codigo
    public function getIdViaje(){
        return $this->idViaje;
    }
    //Setea el codigo
    public function setIdViaje($idViaje){
        $this->idViaje = $idViaje;
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
    public function setResponsable($responsable){
        $this->responsable = $responsable;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function setImporte($importe){
        $this->importe = $importe;
    }
    public function getIdEmpresa(){
        return $this->idEmpresa;
    }
    public function setIdEmpresa($idEmpresa){
        $this->idEmpresa = $idEmpresa;
    }
    public function getEmpresa(){
        return $this->empresa;
    }
    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}
    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}
    
    //Muestra por pantalla
    public function __toString(){
        return ("Datos del viaje: " . 
        "\n" . "Id Viaje: " . $this->getIdViaje() .
        "\n" . "Id Empresa: " . $this->getEmpresa() . 
        "\n" . "Destino: " . $this->getDestino() . 
        "\n" . "Cantidad maxima de pasajeros: " . $this->getCantMax() .  
        "\n" . "Responsable: " . $this->getResponsable() . 
        "\n" . "Costo del viaje: " . $this->getImporte() . 
        "\n" );
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


        public function Buscar($idViaje){
            $base=new BaseDatos();
            $consultaViaje="Select * from viaje where idviaje =".$idViaje;
            $resp= false;
            if($base->Iniciar()){
                if($base->Ejecutar($consultaViaje)){
                    if($row2=$base->Registro()){					
                        $this->setIdViaje($idViaje);
                        $this->setDestino($row2['vdestino']);
                        $this->setCantMax($row2['vcantmaxpasajeros']);
                        $this->setIdEmpresa($row2['idempresa']);
                        $this->setResponsable($row2['rnumeroempleado']);
                        $this->setImporte($row2['vimporte']);
                        $resp= true;
                    }				
                
                 }	else {
                         $this->setmensajeoperacion($base->getError());
                     
                }
             }	else {
                     $this->setmensajeoperacion($base->getError());
                 
             }		
             return $resp;
        }	

        public function insertar(){
            $base=new BaseDatos();
            $resp= false;
            $consultaInsertar = "INSERT INTO viaje(vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte) 
                        VALUES ('".$this->getDestino()."','".$this->getCantMax()."','".$this->getEmpresa()->getIdEmpresa()."','".$this->getResponsable()->getNroEmpleado()."','".$this->getImporte()."')";
            
            if($base->Iniciar()){
    
                if($id = $base->devuelveIDInsercion($consultaInsertar)){
                    $this->setIdViaje($id);
                    $resp=  true;
    
                }	else {
                        $this->setmensajeoperacion($base->getError());
                        
                }
    
            } else {
                    $this->setmensajeoperacion($base->getError());
                
            }
            return $resp;
        }

        public function modificar(){
            $resp =false; 
            $base=new BaseDatos();
            $consultaModifica="UPDATE viaje SET vdestino='".$this->getDestino()."',vcantmaxpasajeros='".$this->getCantMax()."' ,idempresa='".$this->getIdEmpresa()."' ,rnumeroempleado='".$this->getResponsable()->getNroEmpleado()."',vimporte='".$this->getImporte()."' WHERE idviaje=". $this->getIdViaje();
    
            if($base->Iniciar()){
                if($base->Ejecutar($consultaModifica)){
                    $resp=  true;
                }else{
                    $this->setmensajeoperacion($base->getError());
                    
                }
            }else{
                    $this->setmensajeoperacion($base->getError());
                
            }
            return $resp;
        }

        public function eliminar(){
            $base=new BaseDatos();
            $resp=false;
            if($base->Iniciar()){
                    $consultaBorra="DELETE FROM viaje WHERE idviaje=".$this->getIdViaje();
                    if($base->Ejecutar($consultaBorra)){
                        $resp=  true;
                    }else{
                            $this->setmensajeoperacion($base->getError());
                        
                    }
            }else{
                    $this->setmensajeoperacion($base->getError());
                
            }
            return $resp; 
        }

        public function listar($condicion=""){
            $arregloViaje = null;
            $base=new BaseDatos();
            $consultaViaje="Select * from viaje ";
            if ($condicion!=""){
                $consultaViaje=$consultaViaje.' where '.$condicion;
            }
            $consultaViaje.=" order by idviaje";
            //echo $consultaViaje;
            if($base->Iniciar()){
                if($base->Ejecutar($consultaViaje)){				
                    $arregloViaje= array();
                    while($row2=$base->Registro()){
                        
                        $idViaje=$row2['idviaje'];
                        $destino=$row2['vdestino'];
                        $cantMax=$row2['vcantmaxpasajeros'];
                        $idEmpresa=$row2['idempresa'];
                        $responsable=$row2['rnumeroempleado'];
                        $importe=$row2['vimporte'];

                        $viaje=new Viaje();
                        $viaje->cargar($idViaje, $destino, $cantMax, $idEmpresa, $responsable, $importe);
                        array_push($arregloViaje,$viaje);
        
                    }
                    
                
                 }	else {
                         $this->setmensajeoperacion($base->getError());
                     
                }
             }	else {
                     $this->setmensajeoperacion($base->getError());
                 
             }	
             return $arregloViaje;
        }	
    
    
        
}

