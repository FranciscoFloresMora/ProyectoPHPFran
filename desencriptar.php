<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mensaje_encriptado = $_POST['mensaje_encriptado'];
    $mensaje_desencriptado = base64_decode($mensaje_encriptado);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desencriptar Mensaje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Desencriptación Del Mensaje</h1>

    <form method="POST">
        <label for="mensaje_encriptado">Mensaje Encriptado:</label>
        <input type="text" name="mensaje_encriptado" id="mensaje_encriptado" required>
        <button type="submit">Desencriptar</button>
    </form>

    <?php if (isset($mensaje_desencriptado)) { ?>
        <h2>Mensaje Desencriptado:</h2>
        <p><?php echo $mensaje_desencriptado; ?></p>
    <?php } ?>
</body>
</html>