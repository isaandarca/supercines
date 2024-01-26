<?php

session_start();


require 'conexion.php';

if (!empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
    $records = $conn->prepare('SELECT usuario, contrasena FROM usuarios WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['contrasena'], $results['contrasena'])) {
        $_SESSION['usuario'] = $results['usuario'];
        header("Location: /php-cinepagina");
    } else {
        $message = 'Lo siento no es válido el usuario o la contraseña';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="cineregistro.php">Registrarse</a></span>

    <form action="cinelogin.php" method="POST">
        <input name="text" type="text" placeholder="Escribe tu usuario">
        <input name="password" type="password" placeholder="Escribe tu contraseña">
        <input type="submit" value="Submit">
    </form>
</body>

</html>