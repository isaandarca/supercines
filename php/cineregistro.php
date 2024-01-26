<?php

require 'conexion.php';

$message = '';

if (!empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
    $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES (:usuario, :contrasena)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    $stmt->bindParam(':contrasena', $contrasena);

    if ($stmt->execute()) {
        $message = 'Estás registrado correcatmente';
    } else {
        $message = 'No hemos podido crear tu cuenta';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>



    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registro</h1>
    <span>o <a href="cinelogin.php">Login</a></span>

    <form action="cineregistro.php" method="POST">
        <input name="usuario" type="text" placeholder="Escribe tu usuario" required>
        <input name="contrasena" type="password" placeholder="Escribe tu contrasena" required>
        <input name="confirm_contrasena" type="password" placeholder="Confirma tu contrasena" required>
        <input type="submit" value="Submit">
    </form>

</body>

</html>