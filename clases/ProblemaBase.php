<?php
class ProblemaBase {
    protected $titulo;
    protected $descripcion;

    public function __construct($titulo, $descripcion) {
        $this->titulo = htmlspecialchars($titulo);
        $this->descripcion = htmlspecialchars($descripcion);
    }

    public function mostrarEncabezado($claseFondo, $imagenRuta) {
        echo "<!DOCTYPE html><html lang='es'><head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='../styles.css'>
        <title>{$this->titulo}</title>
        </head>
        <body class='{$claseFondo}'>
        <section>
            <h2>{$this->titulo}</h2>
            <p>{$this->descripcion}</p>
            <img src='../assets/imgs/{$imagenRuta}' alt='Imagen alusiva' class='ilustracion'>
        ";
    }

    public function mostrarCierre() {
        echo "<br><a href='../index.php' class='boton-problema'>Volver al menú principal</a></section>";
        include("../footer.php");
        echo "</body></html>";
    }
}
?>
