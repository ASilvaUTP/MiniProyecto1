<?php
require_once("ProblemaBase.php");

class Problema8 extends ProblemaBase {

    /**
     * Determina la estación del año según rangos de fechas:
     * Verano:     21/12 – 20/03
     * Otoño:      21/03 – 21/06
     * Invierno:   22/06 – 22/09
     * Primavera:  23/09 – 20/12
     */
    public function ejecutar($fecha) {
        // Validar entrada
        if (!$fecha) return ["error" => "⚠️ Seleccione una fecha."];

        $ts = strtotime($fecha);
        if ($ts === false) return ["error" => "⚠️ Fecha inválida."];

        // Mes-día como número para comparar fácilmente (ej.: 0321, 1221, etc.)
        $md = (int) date("md", $ts);
        $fechaFormateada = date("d/m/Y", $ts);

        // Rangos (inclusive)
        // Nota: Verano cruza fin de año (1221–1231 o 0001–0320)
        if ($md >= 1221 || $md <= 320) {
            $estacion = "Verano";
            $rango = "Del 21 de diciembre al 20 de marzo";
        } elseif ($md >= 321 && $md <= 621) {
            $estacion = "Otoño";
            $rango = "Del 21 de marzo al 21 de junio";
        } elseif ($md >= 622 && $md <= 922) {
            $estacion = "Invierno";
            $rango = "Del 22 de junio al 22 de septiembre";
        } else { // 0923–1220
            $estacion = "Primavera";
            $rango = "Del 23 de septiembre al 20 de diciembre";
        }

        return [
            "estacion" => $estacion,
            "rango" => $rango,
            "fecha_formateada" => $fechaFormateada
        ];
    }
}
