<?php

class Empresa{

    private $idEmpresa;
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    public function __construct(){
        $this->idEmpresa = "";
        $this->enombre = "";
        $this->edireccion = "";
    }

    public function getIdEmpresa(){
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa){
        $this->idEmpresa = $idEmpresa;
    }

    public function getNombre(){
        return $this->enombre;
    }

    public function setNombre($enombre){
        $this->enombre = $enombre;
    }

    public function getDireccion(){
        return $this->edireccion;
    }

    public function setDireccion($edireccion){
        $this->edireccion = $edireccion;
    }
    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}
    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}
	

    public function __toString(){
        return ("Datos: " . 
        "\n" . "Id Empresa: " . $this->getIdEmpresa() . 
        "\n" . "Nombre: " . $this->getNombre() . 
        "\n" . "Direccion: " . $this->getDireccion());
    }

    public function insertar()
{
    $base = new BaseDatos();
    $resp = false;

    $consultaInsertar = "INSERT INTO empresa(enombre, edireccion) 
                         VALUES ('" . $this->getNombre() . "','" . $this->getDireccion() . "')";

    if ($base->Iniciar()) {
        if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
            
            $this->setIdEmpresa($id);
            $resp = true;
        } else {
            $this->setmensajeoperacion($base->getError());
        }
    } else {
        $this->setmensajeoperacion($base->getError());
    }
    return $resp;
}



    public function cargar($idEmpresa, $nombre, $direccion){		
		$this->setIdEmpresa($idEmpresa);
		$this->setNombre($nombre);
		$this->setDireccion($direccion);
    }

    /**
	 * Recupera los datos de la empresa a partir de su idempresa
	 * @param int $idEmpresa
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idEmpresa){
		$base=new BaseDatos();
		$consultaEmpresa="Select * from empresa where idempresa=" . $idEmpresa;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){
				if($row2=$base->Registro()){					
				    $this->setIdEmpresa($idEmpresa);
					$this->setNombre($row2['enombre']);
					$this->setDireccion($row2['edireccion']);
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

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM empresa WHERE idempresa=".$this->getIdEmpresa();
				if($base->Ejecutar($consultaBorra)){
					$consultaReset = "ALTER TABLE empresa AUTO_INCREMENT = 1";
            		$base->Ejecutar($consultaReset);
				    $resp=  true;
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE empresa SET enombre='".$this->getNombre()."'
                           ,edireccion='".$this->getDireccion()."' WHERE idempresa=". $this->getIdEmpresa();
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

	public function listar($condicion=""){
	    $arregloEmpresa = null;
		$base=new BaseDatos();
		$consultaEmpresa="Select * from empresa ";
		if ($condicion!=""){
		    $consultaEmpresa=$consultaEmpresa.' where '.$condicion;
		}
		$consultaEmpresa.=" order by idempresa ";
		//echo $consultaEmpresa;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){				
				$arregloEmpresa= array();
				while($row2=$base->Registro()){
					
					$idEmpresa=$row2['idempresa'];
					$nombre=$row2['enombre'];
					$direccion=$row2['edireccion'];
					
				
					$empresa=new Empresa();
					$empresa->cargar($idEmpresa, $nombre, $direccion);
					array_push($arregloEmpresa,$empresa);
	
				}
				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloEmpresa;
	}	
	
	

}

    