<!-- Modal -->
<div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="modalPembayaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPembayaranLabel">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Tampilkan Form Pembayaran -->
            <form action="<?= base_url('penjualan/simpanPembayaran'); ?>" class="formPembayaran">
                <div class="modal-body">
                    <div class="form-row">

                        <input type="hidden" id="strukkasir" name="kasir" value="<?= $kasir; ?>">
                        <input type="hidden" id="strukinvoice" name="invoice" value="<?= $invoice; ?>">
                        <input type="hidden" id="strukpelanggan" name="pelanggan" value="<?= $pelanggan; ?>">

                        <div class="form-group col-md-12">
                            <label>Total Pembayaran</label>
                            <input type="text" id="total_pembayaran" name="total_pembayaran" class="form-control" style="font-weight: bold; text-align: right; color: seagreen; font-size: 20pt;" value="<?= $totalbayar; ?>" readonly>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Jumlah Uang</label>
                            <input type="text" id="jumlah_uang" name="jumlah_uang" class="form-control" style="font-weight: bold; text-align: right; color: red; font-size: 20pt;" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sisa Uang</label>
                            <input type="text" id="sisa_uang" name="sisa_uang" class="form-control" style="font-weight: bold; text-align: right; color: blue; font-size: 20pt;" readonly>
                        </div>


                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success tombolBayar">Bayar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        $('#jumlah_uang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#sisa_uang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });
        $('#total_pembayaran').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        //Ketika Jumlah Uang Di Ketik Maka Sisa Uang Akan Muncul
        $('#jumlah_uang').keyup(function() {
            //Ambil Inputan Jumlah Uangnya dan total pembayaran
            let totalPembayaran = $('#total_pembayaran').autoNumeric('get');
            let jumlahUang = ($('#jumlah_uang').val() == "") ? 0 : $('#jumlah_uang').autoNumeric('get');
            //Jumlah Uang - Total Pembayaran
            let sisaUang = parseFloat(jumlahUang) - parseFloat(totalPembayaran);
            //Hasil sisa Uang Masukkan Ke Value 
            $('#sisa_uang').val(sisaUang);

            let sisaUangx = $('#sisa_uang').val();
            $('#sisa_uang').autoNumeric('set', sisaUangx);
        });

        $('.formPembayaran').submit(function(e) {
            e.preventDefault();
            //1.Validasi Form Pembayaran 
            //Cek Kondisi Jika Sudah DiTekan Submit Apakah Inputan Pembayaran Kosong
            //Ambil Inputan Jumlah Uangnya dan total pembayaran
            let sisaUang = ($('#sisa_uang').val() == "") ? 0 : $('#sisa_uang').autoNumeric('get');
            let jumlahUang = ($('#jumlah_uang').val() == "") ? 0 : $('#jumlah_uang').autoNumeric('get');

            if (parseFloat(jumlahUang) == 0 || parseFloat(jumlahUang) == "") {
                //Kalau Jumlah Uang Kosong
                Toast.fire({
                    icon: 'warning',
                    title: 'Uang Belum DiInput'
                })
            } else if (parseFloat(sisaUang) < 0) {
                //Kalau Sisa Uang Minus
                Toast.fire({
                    icon: 'warning',
                    title: 'Uang Belum Mencukupi'
                })
            } else {
                //Simpan Data
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'), //Url diambil dari form action
                    data: $(this).serialize(), //Data nya diambil dari yg ada diform input
                    success: function(response) {
                        //Jika Sukses
                        if (response == 'berhasil') {
                            Swal.fire({
                                title: 'Cetak Struk ?',
                                text: "Apakah Yakin Mau Di Cetak ? ",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, cetak !'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    //Redirect Ke Print Struk Jika Tidak Ingin Langsung Redirect
                                    //window.location = "/penjualan/print";

                                    //Jika Ingin Langsung Redirect Pakai Ajax 
                                    $.ajax({
                                        type: "post",
                                        url: "/penjualan/struk",
                                        data: {
                                            invoice: $('#strukinvoice').val(),
                                            kasir: $('#strukkasir').val(),
                                            totalPembayaran: $('#total_pembayaran').val(),
                                            jumlahUang: $('#jumlah_uang').val(),
                                            sisaUang: $('#sisa_uang').val()
                                        },
                                        success: function(response) {
                                            //Kalau Berhasil
                                            Swal.fire({
                                                title: 'Invoice' + $('#strukinvoice').val(),
                                                text: response,
                                                icon: 'success'
                                            }).then((result) => {
                                                window.location.reload();
                                            })


                                        }
                                    });
                                } else {
                                    window.location.reload();
                                }
                            })
                        }
                    }
                });
            }

            return false;
        });
    });
</script>