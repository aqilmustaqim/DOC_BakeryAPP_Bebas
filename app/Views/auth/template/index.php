<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $title; ?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets'); ?>/images/favicon.png">
    <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">

</head>

<body class="h-100">


    <?= $this->renderSection('content'); ?>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?= base_url('assets'); ?>/vendor/global/global.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/custom.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/deznav-init.js"></script>

</body>

</html>