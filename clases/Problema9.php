<?php
require_once("ProblemaBase.php");

class Problema9 extends ProblemaBase {

    public function ejecutar($numero) {
        // Validar que el número esté entre 1 y 9
        if (!is_numeric($numero) || $numero < 1 || $numero > 9) {
            return ['error' => "⚠️ Debe ingresar un número entre 1 y 9."];
        }

        $numero = intval($numero);
        $resultados = [];

        for ($i = 1; $i <= 15; $i++) {
            $potencia = pow($numero, $i);
            $resultados[] = "{$numero}<sup>{$i}</sup> = {$potencia}";
        }

        return ['potencias' => $resultados, 'numero' => $numero];
    }
}
?>
