<?php
// Procesar los datos de la encuesta y guardarlos en un archivo CSV

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $tipoMusica = $_POST['music'] ?? 'No especificado'; // Tipo de música seleccionado
    $otraMusica = $_POST['other_music'] ?? ''; // Otra música (si aplica)

    // Si eligieron "Otras", usar el valor del campo de texto
    if ($tipoMusica === 'otras' && !empty($otraMusica)) {
        $tipoMusica = $otraMusica;
    }

    // Obtener la fecha y hora actual
    $fechaVoto = date("Y-m-d H:i:s");

    // Preparar los datos para guardar en el archivo CSV
    $datos = [$tipoMusica, $fechaVoto];

    // Abrir el archivo CSV en modo "a" (append) para agregar al final
    $archivo = fopen("resultados-encuesta.csv", "a");

    if ($archivo) {
        // Escribir los datos en el archivo CSV
        fputcsv($archivo, $datos);

        // Cerrar el archivo
        fclose($archivo);

        echo "¡Gracias por votar!";
    } else {
        echo "Error al guardar los datos.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
