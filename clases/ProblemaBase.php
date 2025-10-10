<?php
// Clase base que proporciona título, descripción y métodos para mostrar la plantilla HTML
class ProblemaBase {
    protected $titulo;
    protected $descripcion;

    // Constructor: guarda título y descripción escapando HTML para evitar XSS
    public function __construct($titulo, $descripcion) {
        $this->titulo = htmlspecialchars($titulo);
        $this->descripcion = htmlspecialchars($descripcion);
    }

    // Imprime la cabecera HTML y abre el cuerpo con una clase de fondo (para estilos)
    public function mostrarFondo($claseFondo) {
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
        ";
    }

    // Imprime el cierre de la sección, añade enlace para volver y carga el footer
    public function mostrarCierre() {
        echo "<br><a href='../index.php' class='boton-problema'>Volver al menú principal</a></section>";
        include("../footer.php");
        echo "</body></html>";
    }
}
?>
