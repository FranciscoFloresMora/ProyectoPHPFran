<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensaje = $_POST['mensaje'];
    $mensaje_encriptado = base64_encode($mensaje);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encriptar Mensaje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Encriptación del Mensaje</h1>
    <form method="POST">
        <label for="mensaje">Mensaje a encriptar:</label>
        <input type="text" name="mensaje" id="mensaje" required>
        
        <button type="submit">Encriptar</button>
    </form>

    <?php if (isset($mensaje_encriptado)) { ?>
        <div class="success">
            <p>Mensaje Encriptado: <?php echo $mensaje_encriptado; ?></p>
        </div>
    <?php } ?>
</body>
</html>