<?php
require_once("ProblemaBase.php");

class Problema5 extends ProblemaBase {

    public function ejecutar($edades) {
        if (!is_array($edades) || count($edades) !== 5) {
            return ['error' => "⚠️ Debe ingresar exactamente 5 edades."];
        }

        $detalle = [];
        $conteo = ["nino" => 0, "adolescente" => 0, "adulto" => 0, "adulto_mayor" => 0];

        foreach ($edades as $idx => $e) {
            if ($e === "" || !is_numeric($e) || $e < 0 || $e > 120) {
                return ['error' => "⚠️ Edad inválida en el campo #".($idx+1)."."];
            }
            $edad = (int)$e;
            $cat = $this->categorizar($edad);
            $detalle[] = ["n" => $idx + 1, "edad" => $edad, "categoria" => $cat];

            switch ($cat) {
                case "Niño": $conteo["nino"]++; break;
                case "Adolescente": $conteo["adolescente"]++; break;
                case "Adulto": $conteo["adulto"]++; break;
                case "Adulto mayor": $conteo["adulto_mayor"]++; break;
            }
        }

        return ["detalle" => $detalle, "conteo" => $conteo];
    }

    private function categorizar($edad) {
        if ($edad <= 12) return "Niño";
        if ($edad <= 17) return "Adolescente";
        if ($edad <= 64) return "Adulto";
        return "Adulto mayor";
    }
}
