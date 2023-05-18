<?php

class PasajeroConNecesidad extends Pasajero{
    private $sillaDeRuedas;
    private $asistencia;
    private $comidas;

    public function __construct($nombre, $apellido, $nroDni, $telefono, $nroAsiento, $nroTicket, $sillaDeRuedas, $asistencia, $comidas){
        parent::__construct($nombre, $apellido, $nroDni, $telefono, $nroAsiento, $nroTicket);
        $this->sillaDeRuedas = $sillaDeRuedas;
        $this->asistencia = $asistencia;
        $this->comidas = $comidas;
    }
    public function getSillaDeRuedas(){
        return $this->sillaDeRuedas;
    }
    public function setSillaDeRuedas($sillaDeRuedas){
        $this->sillaDeRuedas = $sillaDeRuedas;
    }
    public function getAsistencia(){
        return $this->asistencia;
    }
    public function setAsistencia($asistencia){
        $this->asistencia = $asistencia;
    }
    public function getComidas(){
        return $this->comidas;
    }
    public function setComidas($comidas){
        $this->comidas = $comidas;
    }
    public function __toString(){
        return (parent::__toString() . 
        "\n" . "Silla de ruedas: " . $this->getSillaDeRuedas() . 
        "\n" . "Asistencia: " . $this->getAsistencia() . 
        "\n" . "Comida: " . $this->getComidas() . "\n");
    }
    // metodos

    public function darPorcentajeIncremento(){
        $sillaDeRuedas = $this->getSillaDeRuedas();
        $asistencia = $this->getAsistencia();
        $comidas = $this->getComidas();
        $porcentaje = 0;
        
        if($sillaDeRuedas == true || $asistencia == true || $comidas == true){
            $porcentaje = 15;
        }elseif($sillaDeRuedas == true && $asistencia == true && $comidas == true){
            $porcentaje = 30;
        }
        return $porcentaje;
    }
}



/**
 * Si el pasajero tiene necesidades especiales y requiere silla de ruedas, asistencia y comida especial entonces el pasaje tiene un incremento del 30%; si solo requiere uno de los servicios prestados entonces el incremento es del 15%.
 */