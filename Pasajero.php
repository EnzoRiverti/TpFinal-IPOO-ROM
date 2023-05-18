<?php

class Pasajero{

    private $nombre;
    private $apellido; 
    private $nroDni;
    private $telefono;
    private $nroAsiento;
    private $nroTicket;

    //Metodos

    public function __construct($nombre, $apellido, $nroDni, $telefono, $nroAsiento, $nroTicket){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroDni = $nroDni;
        $this->telefono = $telefono;
        $this->nroAsiento = $nroAsiento;
        $this->nroTicket = $nroTicket;
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
        return $this->telfono;
    }
    public function setTelefono($newTelefono){
        $this->telefono = $newTelefono;
    }
    public function getNroAsiento(){
        return $this->nroAsiento;
    }
    public function setNroAsiento($newNroAsiento){
        $this->nroAsiento = $newNroAsiento;
    }
    public function getNroTicket($nroTicket){
        return $this->nroTicket;
    }
    public function setNroTicket($nroTicket){
        $this->nroTicket = $nroTicket;
    }

    public function __toString(){
    return ("Datos del pasajero: " . "\n" . "Numero de asiento: " . $this->getNroAsiento() . "Nombre: " . $this->getNombre() . "\n" . "Apellido: " . $this->getApellido() . "\n" . "Numero de DNI: " . $this->getNroDni() . "\n" . "Numero de telefono: " . $this->getTelefono() . "\n" . "Numero de ticket: " . $this->getNroTicket());
 
    }
    //metodos

    public function darPorcentajeIncremento(){
        $porcentaje = 10;
        return $porcentaje;
    } 

}