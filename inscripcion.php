<?php

$error = "";
$nombre = $direccion = $email = $descripcion = $fotografia = "";
$seleccion_opciones = $opciones_check = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $descripcion = $_POST['descripcion'];
    $seleccion_opciones = $_POST['opciones'] ?? [];
    $opciones_check = $_POST['opciones_check'] ?? [];

    
    if (empty($nombre)) {
        $error .= "El nombre es obligatorio. <br>";
    }

    
    if (empty($direccion)) {
        $error .= "La dirección es obligatoria. <br>";
    }

 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "El correo electrónico no es válido. <br>";
    }

  
    if (strlen($descripcion) > 500) {
        $error .= "La descripción no debe superar los 500 caracteres. <br>";
    }

    
    if ($_FILES['fotografia']['error'] != 0) {
        $error .= "Debe subir una fotografía. <br>";
    } else {
        $fotografia = $_FILES['fotografia'];
        
        $allowed_extensions = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($fotografia['type'], $allowed_extensions)) {
            $error .= "El archivo de la fotografía debe ser una imagen (JPEG, PNG, GIF). <br>";
        }
    }

    
    if (empty($error)) {
        
        $fotografia_destino = 'img/' . basename($fotografia['name']);
        move_uploaded_file($fotografia['tmp_name'], $fotografia_destino);

       
        echo "<h3>¡Inscripción exitosa!</h3>";
        echo "Nombre: $nombre <br>";
        echo "Dirección: $direccion <br>";
        echo "Correo electrónico: $email <br>";
        echo "Descripción: $descripcion <br>";
        echo "Fotografía subida: <img src='$fotografia_destino' alt='Fotografía' width='100'> <br>";
        echo "Opciones seleccionadas: " . implode(", ", $seleccion_opciones) . "<br>";
        echo "Checkboxes seleccionados: " . implode(", ", $opciones_check) . "<br>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inscripción</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Formulario de Inscripción Fran</h1>

    
    <?php if (!empty($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

   
    <form method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($direccion); ?>" required>

        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="descripcion">Descripción (máximo 500 caracteres):</label>
        <textarea name="descripcion" id="descripcion" maxlength="500" required><?php echo htmlspecialchars($descripcion); ?></textarea>

        <label for="fotografia">Fotografía:</label>
        <input type="file" name="fotografia" id="fotografia" required>

        <label for="opciones">Seleccione una opción:</label>
        <select name="opciones[]" id="opciones" multiple required>
            <option value="opcion1" <?php echo in_array('opcion1', $seleccion_opciones) ? 'selected' : ''; ?>>Opción 1</option>
            <option value="opcion2" <?php echo in_array('opcion2', $seleccion_opciones) ? 'selected' : ''; ?>>Opción 2</option>
            <option value="opcion3" <?php echo in_array('opcion3', $seleccion_opciones) ? 'selected' : ''; ?>>Opción 3</option>
        </select>

        <label>Seleccione al menos una opción:</label>
        <input type="checkbox" name="opciones_check[]" value="opcionA" <?php echo in_array('opcionA', $opciones_check) ? 'checked' : ''; ?>> Opción A
        <input type="checkbox" name="opciones_check[]" value="opcionB" <?php echo in_array('opcionB', $opciones_check) ? 'checked' : ''; ?>> Opción B
        <input type="checkbox" name="opciones_check[]" value="opcionC" <?php echo in_array('opcionC', $opciones_check) ? 'checked' : ''; ?>> Opción C

        <button type="submit">Enviar Inscripción</button>
    </form>

</body>
</html>