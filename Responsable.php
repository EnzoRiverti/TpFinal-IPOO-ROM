<?php

class Responsable{
    private $rnroEmpleado;
    private $rnroLicencia; 
    private $rnombre;
    private $rapellido;
    private $mensajeoperacion;

    //Metodo constructor
    public function __construct(){
        $this->rnroEmpleado = "";
        $this->rnroLicencia = "";
        $this->rnombre = "";
        $this->rapellido = "";
    }
    public function cargar($nroEmpleado, $nroLicencia, $nombre, $apellido){		
		$this->setNroEmpleado($nroEmpleado);
		$this->setNroLicencia($nroLicencia);
		$this->setNombre($nombre);
		$this->setApellido($apellido);
    }
    //Metodos de acceso
    public function getNroEmpleado(){
        return $this->rnroEmpleado;
    }
    public function setNroEmpleado($newNroEmpleado){
        $this->rnroEmpleado = $newNroEmpleado;
    }
    public function getNroLicencia(){
        return $this->rnroLicencia;
    }
    public function setNroLicencia($newNroLicencia){
        $this->rnroLicencia = $newNroLicencia;
    }
    public function getNombre(){
        return $this->rnombre;
    }
    public function setNombre($newNombre){
        $this->rnombre = $newNombre;
    }
    public function getApellido(){
        return $this->rapellido;
    }
    public function setApellido($newApellido){
        $this->rapellido = $newApellido;
    }
    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}
    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}

    public function __toString(){
        return ("Datos del Responsable: " . "\n" . "Numero del empleado: " . $this->getNroEmpleado() . "\n" . "Numero de licencia: " . $this->getNroLicencia() . "\n" . "Nombre: " . $this->getNombre() . "\n" . "Apellido: " . $this->getApellido() . "\n");
    }
/**
	 * 
	 * @param int $rnumeroempleado
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($rnroEmpleado){
		$base=new BaseDatos();
		$consultaPersona="Select * from responsable where rnumeroempleado =".$rnroEmpleado;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setNroEmpleado($rnroEmpleado);
					$this->setNombre($row2['rnombre']);
					$this->setApellido($row2['rapellido']);
					$this->setNroLicencia($row2['rnumerolicencia']);
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
		$consultaInsertar=	"INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) 
							VALUES (".$this->getNroLicencia().", '".$this->getNombre()."', '".$this->getApellido()."')";

		
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($consultaInsertar)){
				$this->setNroEmpleado($id);
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
		$consultaModifica="UPDATE responsable SET rapellido='".$this->getApellido()."',rnombre='".$this->getNombre()."' ,rnumerolicencia='".$this->getNroLicencia()."' WHERE rnumeroempleado=". $this->getNroEmpleado();
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
				$consultaBorra="DELETE FROM responsable WHERE rnumeroempleado=".$this->getNroEmpleado();
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
	    $arregloResponsable = null;
		$base=new BaseDatos();
		$consultaResponsable="Select * from responsable ";
		if ($condicion!=""){
		    $consultaResponsable=$consultaResponsable.' where '.$condicion;
		}
		$consultaResponsable.=" order by rapellido ";
		//echo $consultaResponsable;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsable)){				
				$arregloResponsable= array();
				while($row2=$base->Registro()){
					
					$nroEmpleado=$row2['rnumeroempleado'];
					$nroLicencia=$row2['rnumerolicencia'];
					$nombre=$row2['rnombre'];
					$apellido=$row2['rapellido'];
				
					$responsable=new Responsable();
					$responsable->cargar($nroEmpleado, $nroLicencia, $nombre, $apellido);
					array_push($arregloResponsable,$responsable);
	
				}
				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloResponsable;
	}	
}