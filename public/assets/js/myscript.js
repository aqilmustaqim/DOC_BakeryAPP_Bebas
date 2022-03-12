// const tombol = document.querySelector('.tombol');
//     tombol.addEventListener('click', function() {
//         Swal.fire({
//             title: 'hello world',
//             text: 'Latihan SweetAlerts',
//             type: 'success'
//         });
//     });

//Flash Data
const swal = $('.swal').data('swal'); //Ambil Data FlashDatanya
if ( swal ){
    //Kalau Ada isinya jalankan sweetalert
    Swal.fire({
        title: 'Data User ',
        text: 'Berhasil ' + swal,
        icon: 'success'
    })
}

const produk = $('.produk').data('produk'); //Ambil Data FlashDatanya
if ( produk ){
    //Kalau Ada isinya jalankan sweetalert
    Swal.fire({
        title: 'Data Produk ',
        text: 'Berhasil ' + produk,
        icon: 'success'
    })
}



//Tombol-hapus
$('.tombol-hapus').on('click',function(e){
    //Matikan fungsi A href nya
    e.preventDefault();
    //Ambil Isi Hrefnya
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Akan Dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          //Tampilkan Href
          document.location.href = href;
        }
      })
});

//Tombol Profile
$('#tombol-edit-profile').on('click',function(){
  
    //Ambil Field Fieldnya
    let id = $('#id').val();
    let nama = $('#nama').val();
    let username = $('#username').val();
    let email = $('#email').val();
    let hint = $('#hint').val();

    if(nama == ''){
      Swal.fire({
        title: 'Data Profile',
        text: 'Nama Tidak Boleh Kosong ! ',
        icon: 'warning'
      });
    }else if(username == ''){
      Swal.fire({
        title: 'Data Profile',
        text: 'Username Tidak Boleh Kosong ! ',
        icon: 'warning'
      });
    }else if(hint == ''){
      Swal.fire({
        title: 'Data Profile',
        text: 'Hint Tidak Boleh Kosong ! ',
        icon: 'warning'
      });
    }else if(email == ''){
      Swal.fire({
        title: 'Data Profile',
        text: 'Nama Tidak Boleh Kosong ! ',
        icon: 'warning'
      });
    }else{
      $.ajax({
        method: "POST",
        url: "/users/updateProfile",
        data: {
          id : id,
          nama : nama,
          username : username,
          email : email,
          hint : hint
        },
        success: function(data){
          if(data == "1"){
            Swal.fire({
              title: 'Data Profile',
              text: 'Berhasil DiUbah',
              icon: 'success'
            }).then((result) => {
              window.location.href = "/auth/logout";
            })
          }else{
            Swal.fire({
              title: 'Data Profile',
              text: data,
              icon: 'danger'
            })
          }
        }
    });
    }

    
});

//tombol tambah kategori
$('.tombol-tambah-kategori').on('click', function(){
  //Tangkap Inputan Dari Form
  let kategori = $('#kategori').val();
  if(kategori == ''){
    //Kasih swal
    Swal.fire({
      title: 'Data Kategori',
      text: 'Tidak Boleh Kosong',
      icon: 'warning'
    });
  }else{
    //Jalankan Ajax
    $.ajax({
      method: "POST",
      url: "/master/tambahKategori",
      data: {
        kategori : kategori
      },
      success: function(data){
        if(data == "1"){
          Swal.fire({
            title: 'Data Kategori',
            text: 'Berhasil Tambahkan',
            icon: 'success'
          }).then((result) => {
            document.location.reload();
          })
          
        }

      }
  });
  }

});


//Tambah Satuan
$('.tombol-tambah-satuan').on('click', function(){
  //Tangkap Inputan Dari Form
  let satuan = $('#satuan').val();
  if(satuan == ''){
    //Kasih swal
    Swal.fire({
      title: 'Data Satuan',
      text: 'Tidak Boleh Kosong',
      icon: 'warning'
    });
  }else{
    //Jalankan Ajax
    $.ajax({
      method: "POST",
      url: "/master/tambahSatuan",
      data: {
        satuan : satuan
      },
      success: function(data){
        if(data == "1"){
          Swal.fire({
            title: 'Data Kategori',
            text: 'Berhasil Tambahkan',
            icon: 'success'
          }).then((result) => {
            document.location.reload();
          })
          
        }

      }
  });
  }

});


//Auto Numeric
$(document).ready(function() {
  $('#modal').autoNumeric('init', {
      aSep: ',',
      aDec: '.',
      mDec: '0'
  });
  $('#harga_jual').autoNumeric('init', {
    aSep: ',',
    aDec: '.',
    mDec: '0'
});
$('#nominal_kas').autoNumeric('init', {
  aSep: ',',
  aDec: '.',
  mDec: '0'
});
});

$(document).ready(function(){
  dataDetailPenjualan();
  tampilTotalBayar();

  $('#kodeproduk').keydown(function(e){
    if(e.keyCode == 13){
      e.preventDefault();
      cekKodeProduk();
    }
  });
});

  function dataDetailPenjualan(){
    $.ajax({
      type: "post",
      url: "/penjualan/detailPenjualan",
      data: {
        invoice : $('#invoice').val()
      },
      dataType: "json",
      success: function(response){
        
          $('.dataDetailPenjualan').html(response.data);
       
      }
    });
  }

  function cekKodeProduk(){
    //Tangkap Value dari inputan Kode Produk
    let kodeProduk = $('#kodeproduk').val();
    let namaproduk = $('#namaproduk').val();
    //Jalankan Ajax
    if(kodeProduk == ''){
      //Ketika Kosong Maka Akan Tampilkan Modal Yang Isinya Produk
      $.ajax({
        url: "/penjualan/dataProduk",
        dataType: "json",
        success: function(response){
          //Kalau Berhasil Maka Tampilkan Modalnya
          $('.modalProduk').html(response.viewmodal).show();

          $('#modalproduk').modal('show');
        }
      });  
    }else{
      $.ajax({
        type: "post",
        url: "/penjualan/dataProduk2",
        data: {
          kodeproduk : kodeProduk,
          namaproduk : namaproduk
        },
        dataType: "json",
        success: function(response){
          //Kalau Berhasil Maka Tampilkan Modalnya
          $('.modalProduk').html(response.viewmodal).show();

          $('#modalproduk').modal('show');
          
        }
      });  
    }
  }
  
    $('.tombolTambahKeranjang').on('click', function() {
      //Ambil Isi Field 
      let kodeproduk = $('#kodeproduk').val();
      let namaproduk = $('#namaproduk').val();
      let invoice = $('#invoice').val();
      let jumlah = $('#jumlah').val();

      if(kodeproduk == ''){
        Swal.fire({
          title: 'Kode Produk',
          text: 'Tidak Boleh Kosong',
          icon: 'warning'
        });
     }else if(jumlah == ''){
      Swal.fire({
        title: 'Nama Produk',
        text: 'Tidak Boleh Kosong',
        icon: 'warning'
      });
     }else{
      //Jalankan Ajax
        $.ajax({
          type: "post",
          url: "/penjualan/simpanTemp",
          data: {
            kodeproduk : kodeproduk,
            namaproduk : namaproduk,
            invoice : invoice,
            jumlah : jumlah
          },
          dataType: "json",
          success : function(response){
            if(response == "1"){
              //Tampilkan Detailnya 
              dataDetailPenjualan();
              //Ketika Sudah Ditambahkan Kosongkan Field Nya
              kosongkanField();
            }
          }
        });
      }
    });

    function kosongkanField(){
        $('#kodeproduk').val('');
        $('#namaproduk').val('');
        $('#jumlah').val('');
        $('#namaproduk').focus();
        
        //setelah dikosongkan tampilkanTotalBayar
        tampilTotalBayar();
    }

    function tampilTotalBayar(){
      //Jalankan Ajax
      let invoice = $('#invoice').val();
      $.ajax({
        type: "post",
        url: "/penjualan/tampilTotalBayar",
        data: {
          //Ambil Data Invoice saja, karena yang akan di ambil jika invoice nya sama
          invoice : invoice
        },
        dataType: "json",
        success : function(response){
          if(response.totalbayar){
            $('#total_bayar').val(response.totalbayar);
          }
        }
      });
    }

    function hapusItem(id, namaproduk) {
      Swal.fire({
          title: 'Apakah Anda Yakin?',
          html: `Produk <strong>${namaproduk}</strong> Akan DiHapus`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Iya, Hapus!'
      }).then((result) => {
          if (result.isConfirmed) {
              //jalankan ajax hapus
              $.ajax({
                  type: "post",
                  url: "/penjualan/hapusItem",
                  data: {
                      id: id
                  },
                  success: function(response) {
                      if(response == "sukses"){
                          dataDetailPenjualan();
                          kosongkanField();
                      }
                  }
              });
          }
      })
  }

  $('#simpanPenjualan').on('click',function(){
    //Cek Nama Pelanggan Kalau Diisi Maka Ambil Value nya kalau tidak diisi isi value nya umum
    let namaPelanggan = $('#nama_pelanggan').val();
    if(namaPelanggan == ''){
      Swal.fire({
        title: 'Nama Pelanggan',
        text: 'Jika Nama Pelanggan Kosong Maka Secara Automatis Akan Dibuat "Umum"',
        icon: 'warning'
      });
      namaPelanggan = $('#nama_pelanggan').val('Umum');
    }
    //Jalankan Ajax
    $.ajax({
      type: "post",
      url: "/penjualan/simpanPenjualan",
      data:{
        invoice : $('#invoice').val(),
        pelanggan : namaPelanggan,
        kasir : $('#kasir').val()
      },
      dataType: "json",
      success: function(response){
        //Tampilkan Modal
        $('.modalPembayaran').html(response.viewmodal).show();

        $('#modalPembayaran').modal('show');
      }
    });
  });

  // Cetak Laporan Penjualan
  $('.tombol-cetak-penjualan').on('click', function() {
    
    //Ambil Tanggal Cetak
    let tanggalCetak = $('#tanggal_cetak').val();
    let tanggalCetak2 = $('#tanggal_akhir').val();

    if(tanggalCetak == ""){
      Swal.fire({
        title: "Cetak Laporan Penjualan",
        text: "Tanggal Awal Tidak Boleh Kosong !",
        icon: "warning"
      });
    }else if(tanggalCetak2 == ""){
      Swal.fire({
        title: "Cetak Laporan Penjualan",
        text: "Tanggal Akhir Tidak Boleh Kosong !",
        icon: "warning"
      });
    }else{
      //Ajax 
      $.ajax({
        type: "post",
        url: "/penjualan/laporanPenjualan",
        data: {
          tanggalAwal : tanggalCetak,
          tanggalAkhir : tanggalCetak2
        },
        success : function(msg){
          if(msg == "kosong"){
            Swal.fire({
              title: "Cetak Laporan Penjualan",
              text: "Tidak Ada Penjualan Pada Tanggal Tersebut !",
              icon: "warning"
            });
          }
        }
      });
    }
    
    //Ajax
  });

//tombol tambah kas keluar
$('.tombol-tambah-kaskeluar').on('click', function(){
  //Tangkap Inputan Dari Form
  let keterangan = $('#keterangan_kas').val();
  let tanggal = $('#tanggal_kas').val();
  let nominal = $('#nominal_kas').val();

  if(keterangan == ''){
    //Kasih swal
    Swal.fire({
      title: 'Kas Keluar',
      text: 'Keterangan Tidak Boleh Kosong',
      icon: 'warning'
    });
  }else if(tanggal == ''){
    //Kasih swal
    Swal.fire({
      title: 'Kas Keluar',
      text: 'Tanggal Tidak Boleh Kosong',
      icon: 'warning'
    });
  }else if(nominal == ''){
    //Kasih swal
    Swal.fire({
      title: 'Kas Keluar',
      text: 'Nominal Tidak Boleh Kosong',
      icon: 'warning'
    });
  }else{
    //Jalankan Ajax
    $.ajax({
      method: "POST",
      url: "/master/tambahKasKeluar",
      data: {
        keterangan : keterangan,
        tanggal : tanggal,
        nominal : nominal
      },
      success: function(data){
        if(data == "1"){
          Swal.fire({
            title: 'Data Kas Keluar',
            text: 'Berhasil Tambahkan',
            icon: 'success'
          }).then((result) => {
            document.location.reload();
          })
          
        }

      }
  });
  }

});

