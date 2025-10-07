<?php
require_once("ProblemaBase.php");

class Problema4 extends ProblemaBase {

    public function ejecutar() {
        $sumaPares = 0;
        $sumaImpares = 0;

        for ($i = 1; $i <= 200; $i++) {
            if ($i % 2 == 0) {
                $sumaPares += $i;
            } else {
                $sumaImpares += $i;
            }
        }

        return [
            'pares' => $sumaPares,
            'impares' => $sumaImpares
        ];
    }
}
?>
