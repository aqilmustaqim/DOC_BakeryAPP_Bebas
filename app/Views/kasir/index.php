<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 align-items-start">
            <div class="mr-auto d-none d-lg-block">
                <h2 class="text-black font-w600 mb-0">Dashboard</h2>
                <p class="mb-0">Welcome to BakeryAPP <?= session()->get('nama'); ?></p>
            </div>


        </div>
        <div class="row">


            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-danger">
                    <div class="card-body  p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="flaticon-381-calendar-1"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1"> Penjualan</p>
                                <h3 class="text-white"><?= $penjualan; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>



    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->
<?= $this->endSection(); ?>