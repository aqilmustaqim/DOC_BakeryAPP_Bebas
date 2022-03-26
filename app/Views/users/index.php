<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>


<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">


        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Users</h4>

                    <div class="swal" data-swal="<?= session()->getFlashdata('users'); ?>"></div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#TambahDataUser"><i class="fa fas fa-user-plus"></i>Tambah Data User</button>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0 table-striped">
                                <thead>
                                    <tr>

                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Bergabung</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="customers">
                                    <?php foreach ($users as $u) : ?>
                                        <tr class="btn-reveal-trigger">
                                            <td class="py-3">
                                                <div class="media d-flex align-items-center">
                                                    <div class="media-body">
                                                        <h5 class="mb-0 fs--1"><?= $u['nama']; ?></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-2"><?= $u['email']; ?></td>
                                            <td class="py-2"><?= $u['username']; ?></td>
                                            <td class="py-2">
                                                <?php
                                                if ($u['role_id'] == 1) {
                                                    echo '<span class="badge badge-pill badge-primary font-size-12"> Admin </span>';
                                                } else if ($u['role_id'] == 2) {
                                                    echo '<span class="badge badge-pill badge-danger font-size-12"> Kasir </span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="py-2"><?= date('d-M-Y', strtotime($u['created_at'])); ?></td>
                                            <td>
                                                <a href="" class="badge badge-info" data-toggle="modal" data-target="#UbahDataModal<?= $u['id_users']; ?>"><i class="fa fas fa-edit"></i></a>
                                                <a href="<?= base_url(); ?>/users/hapusData/<?= $u['id_users']; ?>" class="badge badge-danger tombol-hapus"><i class="fa fas fa-trash"></i></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="TambahDataUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <form action="<?= base_url('users/tambahUser'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama User..." required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Masukkan email User..." required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username User..." required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password User..." required>
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Pilih Role...</label>
                            <select id="inputState" name="role" class="form-control" tabindex="-98">

                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary tombol-tambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Ubah Data Modal -->

<?php foreach ($users as $u) : ?>
    <div class="modal fade" id="UbahDataModal<?= $u['id_users']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form action="<?= base_url('users/ubahData'); ?>/<?= $u['id_users']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?= $u['nama']; ?>" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="<?= $u['email']; ?>" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?= $u['username']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ubah Role...</label>
                                <select id="inputState" name="role" class="form-control" tabindex="-98">
                                    <option value="<?= $u['id_role']; ?>" selected><?= $u['role']; ?></option>
                                    <?php foreach ($role as $r) : ?>
                                        <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary tombol-ubah">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>