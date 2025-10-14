<?php
require_once("../clases/Problema8.php");

// Instancia del problema con título y descripción acorde a los rangos
$problema = new Problema8(
    "Problema #8: Estación del Año (por rangos de fecha)",
    "Ingrese una fecha y se devolverá la estación correspondiente según estos rangos: 
    Verano (21 dic–20 mar), Otoño (21 mar–21 jun), Invierno (22 jun–22 sep), Primavera (23 sep–20 dic)."
);

$resultado = [];

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fecha = $_POST['fecha'] ?? "";
    $resultado = $problema->ejecutar($fecha);
}

// Cabecera / plantilla
$problema->mostrarFondo("fondo-problema8");
?>

<div class="contenedor-problema">
    <form method="post" class="form-problema estacion-form">
        <div class="form-group">
            <label class="form-label">Seleccione una fecha:</label>
            <input type="date" name="fecha" required class="form-input fecha-input" value="<?= htmlspecialchars($_POST['fecha'] ?? '') ?>">
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
            $estacion = $resultado["estacion"];
            $rango = $resultado["rango"] ?? "";
            $fechaFormateada = $resultado["fecha_formateada"] ?? ($fecha ?? "");

            // Mapas de imágenes e iconos
            $imagenesEstaciones = [
                'Verano'     => 'verano.png',
                'Otoño'      => 'otono.png',
                'Invierno'   => 'invierno.png',
                'Primavera'  => 'primavera.png'
            ];
            $iconos = [
                'Verano'     => '☀️',
                'Otoño'      => '🍂',
                'Invierno'   => '⛄',
                'Primavera'  => '🌸'
            ];

            $imagen = $imagenesEstaciones[$estacion] ?? 'estacion-default.png';

            // Rutas
            $rutaImagen  = "../assets/imgs/" . $imagen;
            $rutaDefault = "../assets/imgs/estacion-default.png";

            if (!file_exists($rutaImagen)) {
                $rutaImagen = $rutaDefault;
            }
            ?>
            <div class="resultado-estacion">
                <div class="tarjeta-estacion">
                    <div class="imagen-estacion">
                        <img src="<?= $rutaImagen ?>" alt="<?= htmlspecialchars($estacion) ?>"
                             onerror="this.onerror=null; this.src='<?= $rutaDefault ?>'">
                    </div>

                    <div class="info-estacion">
                        <div class="estacion-icono"><?= $iconos[$estacion] ?? '🌍' ?></div>

                        <h3 class="estacion-titulo" data-estacion="<?= htmlspecialchars($estacion) ?>">
                            <?= htmlspecialchars($estacion) ?>
                        </h3>

                        <div class="estacion-datos">
                            <div class="dato-fecha">
                                <span class="dato-label">Fecha seleccionada:</span>
                                <span class="dato-valor"><?= htmlspecialchars($fechaFormateada) ?></span>
                            </div>
                            <div class="dato-rango">
                                <span class="dato-label">Rango aplicado:</span>
                                <span class="dato-valor"><?= htmlspecialchars($rango) ?></span>
                            </div>
                        </div>

                        <div class="estacion-descripcion">
                            <?php
                            $descripciones = [
                                'Verano'    => 'Estación más cálida del año. Días largos y soleados, perfectos para actividades al aire libre.',
                                'Otoño'     => 'Temporada de cosecha y cambio de colores. Las hojas caen y las temperaturas comienzan a descender.',
                                'Invierno'  => 'Estación más fría del año. Días cortos, noches largas y en algunas regiones, nieve.',
                                'Primavera' => 'Temporada de florecimiento y renacimiento. Los días se alargan y las temperaturas se vuelven más cálidas.'
                            ];
                            echo htmlspecialchars($descripciones[$estacion] ?? 'Estación determinada por rangos de fecha.');
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
?>
