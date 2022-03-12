<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $title; ?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets'); ?>/images/favicon.png">
    <link href="<?= base_url('assets'); ?>/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/chartist/css/chartist.min.css">
    <!-- Datatable -->
    <link href="<?= base_url('assets'); ?>/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">




</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <?= $this->include('templates/navheader'); ?>

        <?= $this->include('templates/sidebar'); ?>

        <?= $this->renderSection('content'); ?>

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © BakeryAPP &amp; Developed by <a href="" target="_blank">Aqil Mustaqim </a><?= date('Y'); ?></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?= base_url('assets'); ?>/vendor/global/global.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/custom.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/deznav-init.js"></script>

    <!-- Counter Up -->
    <script src="<?= base_url('assets'); ?>/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/jquery.counterup/jquery.counterup.min.js"></script>

    <!-- Apex Chart -->
    <script src="<?= base_url('assets'); ?>/vendor/apexchart/apexchart.js"></script>

    <!-- Chart piety plugin files -->
    <script src="<?= base_url('assets'); ?>/vendor/peity/jquery.peity.min.js"></script>

    <!-- Dashboard 1 -->
    <script src="<?= base_url('assets'); ?>/js/dashboard/dashboard-1.js"></script>

    <!-- Sweet Alert -->

    <script src="<?= base_url('assets'); ?>/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/plugins-init/sweetalert.init.js"></script>
    <script src="<?= base_url('assets'); ?>/js/myscript.js"></script>

    <!-- Datatable -->
    <script src="<?= base_url('assets'); ?>/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/plugins-init/datatables.init.js"></script>

    <!-- AutoNumeric -->
    <script src="<?= base_url('assets'); ?>/js/autoNumeric.js"></script>
</body>

</html>