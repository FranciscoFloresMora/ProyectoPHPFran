<?php

$error = "";
$resultado = null;
$numero1 = $numero2 = "";
$operacion = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $numero1 = $_POST['numero1'];
    $numero2 = $_POST['numero2'];
    $operacion = $_POST['operacion'];

    
    if (!($numero1 === 'true' || $numero1 === 'false') || !($numero2 === 'true' || $numero2 === 'false')) {
        $error = "Por favor, ingrese valores válidos (true o false). <br>";
    }

    $numero1 = ($numero1 === 'true');
    $numero2 = ($numero2 === 'true');

   
    if (empty($error)) {
        switch ($operacion) {
            case 'and':
                $resultado = $numero1 && $numero2;
                break;
            case 'or':
                $resultado = $numero1 || $numero2;
                break;
            case 'xor':
                $resultado = $numero1 != $numero2;
                break;
            default:
                $error = "Operación no válida. <br>";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones Lógicas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Operaciones Lógicas Fran</h1>

   
    <?php if (!empty($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>


    <form method="POST">
        <label for="numero1">Número 1 (true o false):</label>
        <input type="text" name="numero1" id="numero1" value="<?php echo htmlspecialchars($numero1); ?>" required>

        <label for="numero2">Número 2 (true o false):</label>
        <input type="text" name="numero2" id="numero2" value="<?php echo htmlspecialchars($numero2); ?>" required>

        <label for="operacion">Operación lógica:</label>
        <select name="operacion" id="operacion" required>
            <option value="and" <?php echo ($operacion == 'and') ? 'selected' : ''; ?>>AND</option>
            <option value="or" <?php echo ($operacion == 'or') ? 'selected' : ''; ?>>OR</option>
            <option value="xor" <?php echo ($operacion == 'xor') ? 'selected' : ''; ?>>XOR</option>
        </select>

        <button type="submit">Calcular</button>
    </form>

    <?php if ($resultado !== null) { ?>
        <h2>Resultado:</h2>
        <p>El resultado de la operación lógica es: <?php echo $resultado ? 'true' : 'false'; ?></p>
    <?php } ?>

</body>
</html>