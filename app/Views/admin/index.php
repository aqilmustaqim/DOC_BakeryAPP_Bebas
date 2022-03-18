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
                <p class="mb-0">Welcome to Bakery APP <strong><?= session()->get('nama'); ?> </strong>!</p>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-success">
                    <div class="card-body  p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="flaticon-381-calendar-1"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Total Produk</p>
                                <h3 class="text-white"><?= $produk; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-secondary">
                    <div class="card-body  p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="la la-graduation-cap"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Kategori</p>
                                <h3 class="text-white"><?= $kategori; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-warning">
                    <div class="card-body  p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="la la-user"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Total Users</p>
                                <h3 class="text-white"><?= $users; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-primary">
                    <div class="card-body p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="flaticon-381-user-7"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Admin</p>
                                <h3 class="text-white"><?= $admin; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-info">
                    <div class="card-body p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="flaticon-381-user-7"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Kasir</p>
                                <h3 class="text-white"><?= $kasir; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-blue">
                    <div class="card-body p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="la la-dollar"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Penjualan <?= date('M'); ?></p>
                                <h3 class="text-white" style="font-size: 20pt;"><?= number_format($totalpenjualanbulanan); ?></h3>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-red">
                    <div class="card-body p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="la la-dollar"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Penjualan <?= date('Y'); ?></p>
                                <h3 class="text-white" style="font-size: 20pt;"><?= number_format($totalpenjualantahunan); ?></h3>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-6 col-lg-6 col-md-12">
                <div class="card" style="border: 2px solid black;">
                    <div class="card-header border-0 pb-0 d-sm-flex d-block">
                        <div>
                            <h4 class="card-title mb-1" style="font-weight: bold;">Pemasukan Harian</h4>
                            <small class="mb-0"><?= date('Y-m-d'); ?></small>
                        </div>
                    </div>
                    <div class="card-body orders-summary">
                        <div class="d-flex order-manage p-3 align-items-center mb-4">
                            <h4 class="mb-0" style="font-size: 25pt; font-weight: bold; text-align: center;">Rp. <?= number_format($totalpenjualan); ?></h4>
                        </div>
                        <hr>
                        <!-- Isi Riwayat Transaksi -->
                        <?php $nomor = 1;
                        ?>
                        <?php foreach ($datapenjualan as $dp) :
                        ?>
                            <div class="media items-list-1">
                                <span class="number col-1 px-0 align-self-center"><?= $nomor++; ?></span>

                                <div class="media-body col-sm-4 col-6 col-xxl-6 px-0">
                                    <h5 class="mt-0 mb-0 text-red"><?= $dp['invoice']; ?></h5>
                                    <small class="text-primary font-w500"><strong class="text-secondary mr-2">Rp. <?= number_format($dp['total']); ?></strong> - <?= $dp['kasir']; ?> </small>
                                </div>
                            </div>
                        <?php endforeach;
                        ?>


                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-xxl-6 col-lg-6 col-md-12">
                <div class="card" style="border: 2px solid black;">
                    <div class="card-header border-0 pb-0 d-sm-flex d-block">
                        <div>
                            <h4 class="card-title mb-1">5 Produk Penjualan Terbanyak</h4>
                            <small class="mb-0">All Kategori</small>
                        </div>

                    </div>
                    <div class="card-body p-0 pt-3">
                        <?php $nomor = 1;
                        ?>
                        <?php foreach ($produkterbanyak as $pt) :
                        ?>

                            <div class="media items-list-1">
                                <span class="number col-1 px-0 align-self-center"><?= $nomor++; ?></span>
                                <img class="img-fluid rounded mr-3" width="85" height="85" src="<?= base_url('assets/images/product'); ?>/<?= $pt['foto_produk']; ?>" alt="DexignZone">
                                <div class="media-body col-sm-4 col-6 col-xxl-6 px-0">
                                    <h5 class="mt-0 mb-3 text-black"><?= $pt['nama_produk']; ?></h5>
                                    <small class="text-primary font-w500"><strong class="text-secondary mr-2"><?= number_format($pt['harga_produk']); ?></strong> </small>
                                </div>
                                <div class="media-footer ml-auto col-3 px-0 d-flex align-self-center align-items-center">
                                    <div class="mr-3">
                                        <span class="peity-success" data-style="width:100%;" style="display: none;">0,2,1,4</span><svg class="peity" height="30" width="47">
                                            <polygon fill="rgba(48, 194, 89, .2)" points="0 28.5 0 28.5 15.666666666666666 15 31.333333333333332 21.75 47 1.5 47 28.5"></polygon>
                                            <polyline fill="none" points="0 28.5 15.666666666666666 15 31.333333333333332 21.75 47 1.5" stroke="#30c259" stroke-width="3" stroke-linecap="square"></polyline>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="mb-0 font-w600 text-black"><?= $pt['jumlah_terjual']; ?></h3>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                        ?>

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