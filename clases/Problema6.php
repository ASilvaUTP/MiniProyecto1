<?php
require_once("ProblemaBase.php");

class Problema6 extends ProblemaBase {

    public function ejecutar($presupuesto) {
        if ($presupuesto === null || !is_numeric($presupuesto) || $presupuesto < 0) {
            return ['error' => "⚠️ Ingrese un presupuesto válido (número no negativo)."];
        }

        $p = (float)$presupuesto;
        $areas = [
            ["area" => "Ginecología",   "porcentaje" => 40],
            ["area" => "Traumatología", "porcentaje" => 35],
            ["area" => "Pediatría",     "porcentaje" => 25],
        ];

        foreach ($areas as &$a) {
            $a["monto"] = $p * ($a["porcentaje"] / 100);
        }
        unset($a);

        return ["areas" => $areas, "total" => $p];
    }
}
