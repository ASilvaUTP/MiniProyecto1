<?php
require_once("../clases/Problema8.php");
$problema = new Problema8(
    "Problema #8: Estación del Año",
    "Al ingresar una fecha, devolver la estación del año (hemisferio norte, por mes)."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fecha = $_POST['fecha'] ?? "";
    $resultado = $problema->ejecutar($fecha);
}

$problema->mostrarFondo("fondo-problema8");
?>

<div class="contenedor-problema">
    <form method="post" class="form-problema estacion-form">
        <div class="form-group">
            <label class="form-label">
                Seleccione una fecha:
            </label>
            <input type="date" name="fecha" required class="form-input fecha-input">
        </div>
        <input type="submit" value="Descubrir Estación" class="boton-problema estacion-btn">
    </form>

    <?php if (!empty($resultado)): ?>
        <?php if (!empty($resultado["error"])): ?>
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= htmlspecialchars($resultado["error"]) ?>
            </div>
        <?php else: ?>
            <?php
            // Mapeo de estaciones a imágenes
            $imagenesEstaciones = [
                'Primavera' => 'primavera.png',
                'Verano' => 'verano.png',
                'Otoño' => 'otono.png',
                'Invierno' => 'invierno.png'
            ];
            
            $estacion = $resultado["estacion"];
            $imagen = $imagenesEstaciones[$estacion] ?? 'estacion-default.png';
            
            // Ruta CORRECTA desde problemas/ hacia assets/imgs/
            $rutaImagen = "../assets/imgs/" . $imagen;
            $rutaDefault = "../assets/imgs/estacion-default.png";
            
            // Verificar si el archivo existe
            if (!file_exists($rutaImagen)) {
                $rutaImagen = $rutaDefault;
            }
            ?>
            
            <div class="resultado-estacion">
                <div class="tarjeta-estacion">
                    <div class="imagen-estacion">
                        <img src="<?= $rutaImagen ?>" alt="<?= $estacion ?>" 
                             onerror="this.onerror=null; this.src='<?= $rutaDefault ?>'">
                    </div>
                    
                    <div class="info-estacion">
                        <div class="estacion-icono">
                            <?php 
                            $iconos = [
                                'Primavera' => '🌸',
                                'Verano' => '☀️',
                                'Otoño' => '🍂',
                                'Invierno' => '⛄'
                            ];
                            echo $iconos[$estacion] ?? '🌍';
                            ?>
                        </div>
                        
                        <h3 class="estacion-titulo" data-estacion="<?= $estacion ?>"><?= htmlspecialchars($estacion) ?></h3>
                        
                        <div class="estacion-datos">
                            <div class="dato-fecha">
                                <span class="dato-label">Fecha seleccionada:</span>
                                <span class="dato-valor"><?= htmlspecialchars($resultado["fecha_formateada"] ?? $fecha) ?></span>
                            </div>
                        </div>
                        
                        <div class="estacion-descripcion">
                            <?php
                            $descripciones = [
                                'Primavera' => 'Temporada de florecimiento y renacimiento. Los días se alargan y las temperaturas se vuelven más cálidas.',
                                'Verano' => 'Estación más cálida del año. Días largos y soleados, perfectos para actividades al aire libre.',
                                'Otoño' => 'Temporada de cosecha y cambio de colores. Las hojas caen y las temperaturas comienzan a descender.',
                                'Invierno' => 'Estación más fría del año. Días cortos, noches largas y en algunas regiones, nieve.'
                            ];
                            echo $descripciones[$estacion] ?? 'Estación del año caracterizada por cambios climáticos específicos.';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
$problema->mostrarCierre();