<?php
// index.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Proyecto #2 - Menú Principal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="fondo-principal">
    <header>
        <h1>Resolviendo Problemas con Estructuras de Control y Clases</h1>
        <p>Universidad Tecnológica de Panamá - Ingeniería Web</p>
    </header>

    <main class="menu">
        <h2>Seleccione un problema para resolver:</h2>
        <div class="grid-menu">
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<a href='problemas/problema$i.php' class='boton-problema'>Problema #$i</a>";
            }
            ?>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>
