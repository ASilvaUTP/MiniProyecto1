<?php
require_once("ProblemaBase.php");

class Problema8 extends ProblemaBase {

    public function ejecutar($fecha) {
        if (!$fecha) return ["error" => "⚠️ Seleccione una fecha."];

        $ts = strtotime($fecha);
        if ($ts === false) return ["error" => "⚠️ Fecha inválida."];

        $mes = (int)date("n", $ts);

        // Estaciones por meses (hemisferio norte; simplificado por mes)
        if ($mes >= 3 && $mes <= 5) {
            $estacion = "Primavera";
        } elseif ($mes >= 6 && $mes <= 8) {
            $estacion = "Verano";
        } elseif ($mes >= 9 && $mes <= 11) {
            $estacion = "Otoño";
        } else {
            $estacion = "Invierno";
        }

        return ["estacion" => $estacion];
    }
}
