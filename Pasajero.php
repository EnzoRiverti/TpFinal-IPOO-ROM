<?php

class Pasajero{

    private $nombre;
    private $apellido; 
    private $nroDni;
    private $telefono;
    private $objViaje;
    private $mensajeoperacion;
    

    //Metodos

    public function __construct(){
        $this->nombre = "";
        $this->apellido = "";
        $this->nroDni = "";
        $this->telefono = "";
        $this->objViaje = "";
		$this->idViaje = "";
    }

    public function cargar($nombre, $apellido, $nroDni, $telefono, $objViaje){		
		$this->setNombre($nombre);
		$this->setApellido($apellido);
		$this->setNroDni($nroDni);
		$this->setTelefono($telefono);
        $this->setObjViaje($objViaje);
    }

    //Metodos de acceso
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($newNombre){
        $this->nombre = $newNombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($newApellido){
        $this->apellido = $newApellido;
    }
    public function getNroDni(){
        return $this->nroDni;
    }
    public function setNroDni($newDni){
        $this->nroDni = $newDni;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($newTelefono){
        $this->telefono = $newTelefono;
    }
    public function getObjViaje(){
        return $this->objViaje;
    }
    public function setObjViaje($objViaje){
        $this->objViaje = $objViaje;
    }
	public function getidViaje(){
        return $this->objViaje;
    }
    public function setidViaje($objViaje){
        $this->objViaje = $objViaje;
    }
    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}
    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}
    
    public function __toString(){
    return ("Datos del pasajero: " . 
	"\n" . "Id Viaje: " . $this->getObjViaje() . 
	"\n" . "Nombre: " . $this->getNombre() . 
	"\n" . "Apellido: " . $this->getApellido() . 
	"\n" . "Numero de DNI: " . $this->getNroDni() . 
	"\n" . "Numero de telefono: " . $this->getTelefono() . 
	"\n");
 
    }
    //metodos

    public function darPorcentajeIncremento(){
        $porcentaje = 10;
        return $porcentaje;
    } 

    public function Buscar($pdocumento){
		$base=new BaseDatos();
		$consultaPasajero="Select * from pasajero where pdocumento =".$pdocumento;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajero)){
				if($row2=$base->Registro()){					
				    $this->setNroDni($pdocumento);
					$this->setNombre($row2['pnombre']);
					$this->setApellido($row2['papellido']);
					$this->setTelefono($row2['ptelefono']);
                    $this->setObjViaje($row2['idviaje']);
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
		$consultaInsertar="INSERT INTO pasajero(pdocumento, pnombre, papellido,  ptelefono, idviaje) 
				VALUES (".$this->getNroDni().",'".$this->getNombre()."','".$this->getApellido()."','".$this->getTelefono()."','".$this->getObjViaje()->getIdViaje()."')";
		
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){

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
		$consultaModifica="UPDATE pasajero SET papellido='".$this->getApellido()."',pnombre='".$this->getNombre()."' ,ptelefono='".$this->getTelefono()."' ,idviaje='".$this->getObjViaje()->getidViaje()."' WHERE pdocumento=". $this->getNroDni();

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
				$consultaBorra="DELETE FROM pasajero WHERE pdocumento=".$this->getNroDni();
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
	    $arregloPasajero = null;
		$base=new BaseDatos();
		$consultaPasajero="Select * from pasajero ";
		if ($condicion!=""){
		    $consultaPasajero=$consultaPasajero.' where '.$condicion;
		}
		$consultaPasajero.=" order by papellido ";
		//echo $consultaPasajero;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajero)){				
				$arregloPasajero= array();
				while($row2=$base->Registro()){
					
					$nroDni=$row2['pdocumento'];
					$nombre=$row2['pnombre'];
					$apellido=$row2['papellido'];
					$telefono=$row2['ptelefono'];
                    $objViaje=$row2['idviaje'];
				
					$pasajero=new Pasajero();
					$pasajero->cargar($nombre, $apellido, $nroDni, $telefono, $objViaje);
					array_push($arregloPasajero,$pasajero);
	
				}
				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloPasajero;
	}	

}