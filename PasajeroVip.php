<?php

class PasajeroVip extends Pasajero{
    private $nroFrecuente;
    private $millas;

    public function __construct($nombre, $apellido, $nroDni, $telefono, $nroAsiento, $nroTicket, $nroFrecuente, $millas){
        parent::__construct($nombre, $apellido, $nroDni, $telefono, $nroAsiento, $nroTicket);
        $this->nroFrecuente = $nroFrecuente;
        $this->millas = $millas;        
    }
    public function getNroFrecuente(){
        return $this->nroFrecuente;
    }
    public function setNroFrecuente($nroFrecuente){
        $this->nroFrecuente = $nroFrecuente;
    }
    public function getMillas(){
        return $this->millas;
    }
    public function setMillas($millas){
        $this->millas = $millas;
    }
    public function __toString(){
        return (parent::__toString() . "Numero de pasajero frecuente: " . $this->getNroFrecuente() . "\n" . "Millas: " . $this->getMillas());
    }
    public function darPorcentajeIncremento(){
        $porcentaje = 35;
        $millas = $this->getMillas();
        if($millas > 300){
            $porcentaje += 30;
        }
        return $porcentaje;
    }
}

/**La clase Pasajero tiene como atributos el nombre, el número de asiento y el número de ticket del pasaje del viaje.
 *  La clase "PasajeroVIP" tiene como atributos adicionales el número de viajero frecuente cantidad de millas de pasajero. 
 * Para un pasajero VIP se incrementa el importe un 35% y si la cantidad de millas acumuladas supera a las 300 millas se realiza un incremento del 30%.
 */