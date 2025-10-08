<?php
require_once("../clases/Problema5.php");
$problema = new Problema5(
    "Problema #5: Clasificación de edades",
    "Leer la edad de 5 personas y clasificar cada una: niño (0–12), adolescente (13–17), adulto (18–64), adulto mayor (65+)."
);

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $edades = $_POST['edad'] ?? [];
    $resultado = $problema->ejecutar($edades);
}

$problema->mostrarEncabezado("fondo-problema5", "edades.png"); // ajusta ruta de imagen si usas otra carpeta
?>

<form method="post" class="form-problema">
    <fieldset>
        <legend>Ingrese 5 edades</legend>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label>
                Edad <?= $i ?>:
                <input type="number" name="edad[]" min="0" max="120" required>
            </label>
        <?php endfor; ?>
    </fieldset>
    <input type="submit" value="Clasificar" class="boton-problema">
</form>

<?php if (!empty($resultado)): ?>
    <?php if (!empty($resultado["error"])): ?>
        <p class="mensaje-error"><?= htmlspecialchars($resultado["error"]) ?></p>
    <?php else: ?>
        <h3>Resultados</h3>
        <table class="tabla">
            <thead>
            <tr><th>#</th><th>Edad</th><th>Categoría</th></tr>
            </thead>
            <tbody>
            <?php foreach ($resultado["detalle"] as $fila): ?>
                <tr>
                    <td><?= $fila["n"] ?></td>
                    <td><?= $fila["edad"] ?></td>
                    <td><?= $fila["categoria"] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Estadísticas</h4>
        <ul>
            <li>Niños: <strong><?= $resultado["conteo"]["nino"] ?></strong></li>
            <li>Adolescentes: <strong><?= $resultado["conteo"]["adolescente"] ?></strong></li>
            <li>Adultos: <strong><?= $resultado["conteo"]["adulto"] ?></strong></li>
            <li>Adultos mayores: <strong><?= $resultado["conteo"]["adulto_mayor"] ?></strong></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<?php
$problema->mostrarCierre();
