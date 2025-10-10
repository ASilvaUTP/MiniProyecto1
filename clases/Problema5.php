<?php
require_once("ProblemaBase.php");

// Clase que categoriza 5 edades y devuelve un detalle por campo y el conteo por categoría
class Problema5 extends ProblemaBase {

    // Recibe un array de 5 edades, valida cada una y retorna detalle + conteo o un error
    public function ejecutar($edades) {
        // Validar que se reciban exactamente 5 valores
        if (!is_array($edades) || count($edades) !== 5) {
            return ['error' => "⚠️ Debe ingresar exactamente 5 edades."];
        }

        $detalle = []; // lista con información por campo (posición, edad, categoría)
        $conteo = ["nino" => 0, "adolescente" => 0, "adulto" => 0, "adulto_mayor" => 0];

        foreach ($edades as $idx => $e) {
            // Validación básica de cada edad: no vacía, numérica y en rango plausible
            if ($e === "" || !is_numeric($e) || $e < 0 || $e > 120) {
                return ['error' => "⚠️ Edad inválida en el campo #".($idx+1)."."];
            }
            $edad = (int)$e;
            $cat = $this->categorizar($edad); // obtener categoría textual
            $detalle[] = ["n" => $idx + 1, "edad" => $edad, "categoria" => $cat];

            // Incrementar el contador correspondiente según la categoría
            switch ($cat) {
                case "Niño": $conteo["nino"]++; break;
                case "Adolescente": $conteo["adolescente"]++; break;
                case "Adulto": $conteo["adulto"]++; break;
                case "Adulto mayor": $conteo["adulto_mayor"]++; break;
            }
        }

        // Retornar ambos arreglos para mostrar en la vista
        return ["detalle" => $detalle, "conteo" => $conteo];
    }

    // Clasifica una edad en: Niño, Adolescente, Adulto o Adulto mayor
    private function categorizar($edad) {
        if ($edad <= 12) return "Niño";
        if ($edad <= 17) return "Adolescente";
        if ($edad <= 64) return "Adulto";
        return "Adulto mayor";
    }
}
