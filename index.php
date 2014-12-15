<?php
    define('SITE', true); // защита от прямого доступа к скриптам
    require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head lang="<?= $config['site']['lang'] ?>">
    <meta charset="UTF-8">
    <title><?= $config['site']['title'] ?></title>
    <link href="static/style.css" rel="stylesheet" type="text/css">
    <script src="static/jquery.js" type="text/javascript"></script>
</head>
<body>

<?php
    require 'application.php';
?>

<?php
    Section::_('top');
?>

<div class="left">
    <?php
        Section::_('left');
    ?>
</div>

<div class="right">
    <?php
        Section::_('right');
    ?>
</div>

</body>
</html>
