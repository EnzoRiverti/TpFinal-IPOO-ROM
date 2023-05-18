<?php

    include_once "Viaje.php";
    include_once "Pasajero.php"; 
    include_once "Responsable.php";
    include_once "PasajeroVip.php";
    include_once "PasajeroConNecesidad.php";

    $objPasajero = new Pasajero("Enzo", "Riverti", 41911018, 2994270981, 5, 4);
    $objPasajeroVip = new PasajeroVip("Barbara", "Bravo", 38659572, 2996368452, 9, 6, 18, 350);
    $objPasajeroNecesidad = new PasajeroConNecesidad("Esteban", "Gonzales", 95636541, 2996531277, 6 ,9, true, false, false);
    $objResponsable = new Responsable(5, 56, "Rodrigo", "Aliendro");
    $coleccionPasajeros = [$objPasajero, $objPasajeroVip, $objPasajeroNecesidad];
    $viaje = new Viaje(698, "Plottier", 50, $coleccionPasajeros, $objResponsable, 100,300);

    echo $viaje;