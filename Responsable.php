<?php

class Responsable{
    private $nroEmpleado;
    private $nroLicencia; 
    private $nombre;
    private $apellido;

    //Metodo constructor
    public function __construct($nroEmpleado, $nroLicencia, $nombre, $apellido){
        $this->nroEmpleado = $nroEmpleado;
        $this->nroLicencia = $nroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
    //Metodos de acceso
    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }
    public function setNroEmpleado($newNroEmpleado){
        $this->nroEmpleado = $newNroEmpleado;
    }
    public function getNroLicencia(){
        return $this->nroLicencia;
    }
    public function setNroLicencia($newNroLicencia){
        $this->nroLicencia = $newNroLicencia;
    }
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

    public function __toString(){
        return ("Datos del Responsable: " . "\n" . "Numero del empleado: " . $this->getNroEmpleado() . "\n" . "Numero de licencia: " . $this->getNroLicencia() . "\n" . "Nombre: " . $this->getNombre() . "\n" . "Apellido: " . $this->getApellido() . "\n");
    }
}