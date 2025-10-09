<?php
// index.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Proyecto #1 - Menú Principal</title>
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
            // Arreglo con imágenes por problema
            $imagenes = [
                "problema1" => "Problema1.png",
                "problema2" => "Problema2.png",
                "problema3" => "Problema3.png",
                "problema4" => "Problema4.png",
                "problema5" => "Problema5.png",
                "problema6" => "Problema6.png",
                "problema7" => "Problema7.png",
                "problema8" => "Problema8.png",
                "problema9" => "Problema9.png",
                "problema10" => "Problema10.png"
            ];

            for ($i = 1; $i <= 10; $i++) {
                $ruta = "problemas/problema$i.php";
                $imagen = "assets/imgs/" . ($imagenes["problema$i"] ?? "default.png");

                echo "
                <a href='$ruta' class='tarjeta-problema'>
                    <img src='$imagen' alt='Problema $i' class='icono-problema'>
                    <span>Problema #$i</span>
                </a>";
            }
            ?>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>
