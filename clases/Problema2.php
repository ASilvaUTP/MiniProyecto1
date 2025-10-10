<?php
require_once("ProblemaBase.php");

// Clase que suma los enteros del 1 al 1000
class Problema2 extends ProblemaBase {

    // Calcula la suma de 1 a 1000 y devuelve el resultado en un arreglo
    public function ejecutar() {
        $suma = 0; // acumulador para la suma

        // Iterar de 1 a 1000 y sumar cada entero
        for ($i = 1; $i <= 1000; $i++) {
            $suma += $i;
        }

        // Devolver resultado como arreglo (consistencia con otras clases)
        return [
            'resultado' => $suma
        ];
    }
}
?>
