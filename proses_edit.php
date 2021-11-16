<?php

include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');
echo date('d-m-Y H:i:s');

  $id = $_POST['id'];
  $judul         = $_POST['judul'];
  $pengarang     = $_POST['pengarang'];
  $penerbit      = $_POST['penerbit'];
  $tahun         = $_POST['tahun'];
  $gambar        = $_FILES['gambar']['name'];
  $update        = date("Y-m-d H:i:s");
  
  if($gambar != "") {
    $ekstensi_diperbolehkan = array('png','jpg','jpeg');
    $x = explode('.', $gambar); 
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar; 
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); 
                      
                    
                   $query  = "UPDATE book SET judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit', tahun = '$tahun', gambar = '$nama_gambar_baru', update_at = '$update'";
                    $query .= "WHERE id = '$id'";
                    $result = mysqli_query($koneksi, $query);
                    
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
                    } else {
                      
                      echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.');window.location='tambah_produk.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE book SET judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit', tahun = '$tahun', update_at = '$update'";
      $query .= "WHERE id = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
      }
    }

 

