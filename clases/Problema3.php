<?php
require_once("ProblemaBase.php");

class Problema3 extends ProblemaBase {

    public function ejecutar($n) {
        // Validar que sea número positivo
        if (!is_numeric($n) || $n <= 0) {
            return ['error' => "⚠️ Debe ingresar un número entero positivo."];
        }

        $n = intval($n);
        $resultados = [];

        for ($i = 1; $i <= $n; $i++) {
            $multiplo = 4 * $i;
            $resultados[] = "4 × $i = $multiplo";
        }

        return ['multiplicaciones' => $resultados];
    }
}
?>
