<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a class="" href="<?= base_url(); ?>/<?= (session()->get('role_id') == 1 ? 'admin' : 'kasir'); ?>">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <?php if (session()->get('role_id') == 1) : ?>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Master</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="<?= base_url(); ?>/master/produk">Produk</a></li>
                        <li><a href="<?= base_url(); ?>/master/satuan">Satuan</a></li>
                        <li><a href="<?= base_url(); ?>/master/kategori">Kategori</a></li>
                        <li><a href="<?= base_url(); ?>/master/kasKeluar">Kas Keluar</a></li>
                    </ul>
                </li>

            <?php endif; ?>


            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Penjualan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url(); ?>/penjualan/inputPenjualan">Input Penjualan</a></li>
                    <li><a href="<?= base_url(); ?>/penjualan/dataPenjualan">Data Penjualan</a></li>
                </ul>
            </li>

            <?php if (session()->get('role_id') == 1) : ?>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-layer-1"></i>
                        <span class="nav-text">Users</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="<?= base_url(); ?>/users">Data User</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>

        <br>
        <br>

        <div class="copyright">
            <p><strong>BakeryAPP - System Information</strong> <br>© <?= date('Y'); ?> All Rights Reserved</p>
            <p>Made with <i class="fa fa-heart"></i> by TeamBebas</p>
        </div>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->