<?php
include('model/dao/Mysql.php');
include('model/dao/InformacionDao.php');
$informacionDao = new InformacionDao();
$informacion_r = mysqli_fetch_assoc($informacionDao->select());
date_default_timezone_set('America/Guayaquil');
$date = date('Y-m-d');
$dateTime = date('Y-m-d H:i:s');
include('model/library/loadInformacion.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($informacion_r['informacion_icon'] != null and $informacion_r['informacion_icon'] != "") { ?>
        <link rel="icon" href="<?= $proyect['root_src'] ?>file/informacion_icon/<?= $informacion_r['informacion_icon'] ?>?date=<?= $dateTime ?>">
    <?php } else { ?>
        <link rel="icon" href="<?= $proyect['root_src'] ?>img/logo.png">
    <?php } ?>
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>config.css">
    <link rel="stylesheet" href="<?= $proyect['root_css'] ?>login.css">
    <title>Login - <?= $informacion_r['informacion_nombre'] ?></title>
</head>

<body>

    <form action="#" onsubmit="return false" id="element_form">
        <div class="container">
            <?php if ($informacion_r['informacion_logo'] != null and $informacion_r['informacion_logo'] != "") { ?>
                <img class="logo" src="<?= $proyect['root_src'] ?>file/informacion_logo/<?= $informacion_r['informacion_logo'] ?>?date=<?= $dateTime ?>" alt="Logo">
            <?php } else { ?>
                <img class="logo" src="<?= $proyect['root_src'] ?>img/logo.png" alt="Logo">
            <?php } ?>
            <span><?= strtoupper($informacion_r['informacion_nombre']) ?></span>
            <div class="input">
                <img src="<?= $proyect['root_src'] ?>icon/user.png" alt="user img">
                <input placeholder="usuario" type="text" name="usuario_user">
            </div>
            <div class="input">
                <img src="<?= $proyect['root_src'] ?>icon/pass.png" alt="pass img">
                <input placeholder="Contraseña" type="password" name="usuario_pass">
            </div>
            <label for="save_pass" class="input">
                <input type="checkbox" id="save_pass" name="save_pass">
                <span>Recordar contraseña</span>
            </label>
            <div class="input msg">
                <span class="msg" id="element_msg"></span>
            </div>
            <div class="input submit">
                <input type="submit" value="Iniciar sesion">
            </div>
        </div>
    </form>

    <section class="ideamodal _open" id="sectionProgress">
        <div class="modal-progress">
            <span id="sectionProgressText">Procesando..</span>
            <div class="progress_bar"></div>
        </div>
    </section>

</body>

<foot>
    <script src="control/dao/fetch.js"></script>
    <script src="control/script/login.js"></script>
</foot>

</html>