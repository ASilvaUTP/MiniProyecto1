<?php
require_once("ProblemaBase.php");

// Clase que genera la tabla de multiplicar del 4 hasta un número dado
class Problema3 extends ProblemaBase {

    // Recibe $n, valida y devuelve un arreglo con las multiplicaciones o un error
    public function ejecutar($n) {
        // Comprobar que $n sea un número entero positivo
        if (!is_numeric($n) || $n <= 0) {
            return ['error' => "⚠️ Debe ingresar un número entero positivo."];
        }

        // Convertir a entero y preparar arreglo de resultados
        $n = intval($n);
        $resultados = [];

        // Generar cada línea "4 × i = resultado" desde 1 hasta n
        for ($i = 1; $i <= $n; $i++) {
            $multiplo = 4 * $i;
            $resultados[] = "4 × $i = $multiplo";
        }

        // Devolver las multiplicaciones en la clave 'multiplicaciones'
        return ['multiplicaciones' => $resultados];
    }
}
?>
