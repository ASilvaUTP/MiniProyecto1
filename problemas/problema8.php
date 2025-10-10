<?php
require_once("../clases/Problema8.php");

// Instancia del problema con título y descripción
$problema = new Problema8(
    "Problema #8: Estación del Año",
    "Al ingresar una fecha, devolver la estación del año (hemisferio norte, por mes)."
);

$resultado = [];

// Si se envía el formulario, pedir la fecha y delegar la lógica a la clase
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fecha = $_POST['fecha'] ?? "";
    $resultado = $problema->ejecutar($fecha);
}

// Mostrar cabecera (abre HTML, título y descripción)
$problema->mostrarFondo("fondo-problema8");
?>

<div class="contenedor-problema">
    <!-- Formulario para seleccionar fecha -->
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
            <!-- Mostrar error si la clase devolvió uno -->
            <div class="mensaje-error">
                <i class="error-icon">⚠️</i>
                <?= htmlspecialchars($resultado["error"]) ?>
            </div>
        <?php else: ?>
            <?php
            // Asignar imágenes y elegir la adecuada según la estación
            $imagenesEstaciones = [
                'Primavera' => 'primavera.png',
                'Verano' => 'verano.png',
                'Otoño' => 'otono.png',
                'Invierno' => 'invierno.png'
            ];
            
            $estacion = $resultado["estacion"];
            $imagen = $imagenesEstaciones[$estacion] ?? 'estacion-default.png';
            
            // Ruta relativa correcta desde este archivo hacia assets/imgs/
            $rutaImagen = "../assets/imgs/" . $imagen;
            $rutaDefault = "../assets/imgs/estacion-default.png";
            
            // Si no existe la imagen específica, usar la por defecto
            if (!file_exists($rutaImagen)) {
                $rutaImagen = $rutaDefault;
            }
            ?>
            
            <div class="resultado-estacion">
                <div class="tarjeta-estacion">
                    <div class="imagen-estacion">
                        <!-- Mostrar imagen (fallback por onerror) -->
                        <img src="<?= $rutaImagen ?>" alt="<?= $estacion ?>" 
                             onerror="this.onerror=null; this.src='<?= $rutaDefault ?>'">
                    </div>
                    
                    <div class="info-estacion">
                        <div class="estacion-icono">
                            <?php 
                            // Iconos simples para cada estación
                            $iconos = [
                                'Primavera' => '🌸',
                                'Verano' => '☀️',
                                'Otoño' => '🍂',
                                'Invierno' => '⛄'
                            ];
                            echo $iconos[$estacion] ?? '🌍';
                            ?>
                        </div>
                        
                        <!-- Título con la estación detectada -->
                        <h3 class="estacion-titulo" data-estacion="<?= $estacion ?>"><?= htmlspecialchars($estacion) ?></h3>
                        
                        <div class="estacion-datos">
                            <div class="dato-fecha">
                                <span class="dato-label">Fecha seleccionada:</span>
                                <!-- Mostrar fecha formateada si la clase la proporcionó -->
                                <span class="dato-valor"><?= htmlspecialchars($resultado["fecha_formateada"] ?? $fecha) ?></span>
                            </div>
                        </div>
                        
                        <div class="estacion-descripcion">
                            <?php
                            // Descripciones breves por estación
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
// Cerrar la plantilla (enlace de vuelta y footer)
$problema->mostrarCierre();
?>