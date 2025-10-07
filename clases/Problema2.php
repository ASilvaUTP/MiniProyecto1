<?php
require_once("ProblemaBase.php");

class Problema2 extends ProblemaBase {

    public function ejecutar() {
        $suma = 0;
        for ($i = 1; $i <= 1000; $i++) {
            $suma += $i;
        }

        return [
            'resultado' => $suma
        ];
    }
}
?>
