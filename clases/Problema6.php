<?php
require_once("ProblemaBase.php");

// Clase que reparte un presupuesto entre áreas según porcentajes definidos
class Problema6 extends ProblemaBase {

    // Recibe $presupuesto, valida y devuelve montos por área o un error
    public function ejecutar($presupuesto) {
        // Validación: debe ser un número no negativo
        if ($presupuesto === null || !is_numeric($presupuesto) || $presupuesto < 0) {
            return ['error' => "⚠️ Ingrese un presupuesto válido (número no negativo)."];
        }

        $p = (float)$presupuesto;

        // Áreas y porcentajes de reparto
        $areas = [
            ["area" => "Ginecología",   "porcentaje" => 40],
            ["area" => "Traumatología", "porcentaje" => 35],
            ["area" => "Pediatría",     "porcentaje" => 25],
        ];

        // Calcular monto para cada área (porcentaje * presupuesto)
        foreach ($areas as &$a) {
            $a["monto"] = $p * ($a["porcentaje"] / 100);
        }
        unset($a); // romper la referencia al terminar el foreach

        // Devolver las áreas con sus montos y el total original
        return ["areas" => $areas, "total" => $p];
    }
}
?>
