<?php
require_once("ProblemaBase.php");

class Problema8 extends ProblemaBase {

    // Determina la estación del año a partir de una fecha (hemisferio norte, simplificado)
    public function ejecutar($fecha) {
        // Validar entrada
        if (!$fecha) return ["error" => "⚠️ Seleccione una fecha."];

        // Intentar convertir la fecha a timestamp
        $ts = strtotime($fecha);
        if ($ts === false) return ["error" => "⚠️ Fecha inválida."];

        // Extraer el mes (1-12)
        $mes = (int)date("n", $ts);

        // Mapear mes a estación (simplificado, hemisferio norte)
        if ($mes >= 3 && $mes <= 5) {
            $estacion = "Primavera";
        } elseif ($mes >= 6 && $mes <= 8) {
            $estacion = "Verano";
        } elseif ($mes >= 9 && $mes <= 11) {
            $estacion = "Otoño";
        } else {
            $estacion = "Invierno";
        }

        // Devolver resultado
        return ["estacion" => $estacion];
    }
}
