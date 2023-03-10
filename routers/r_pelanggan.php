<?php

include_once '../controllers/c_pelanggan.php';

$pelanggan = new c_pelanggan();

try {
    if (isset($_POST['tambah']) || isset($_POST['update'])) {        
    
    $id = $_POST['id']; 
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'];
    $tlp = $_POST['telepon'];   

        if ($_GET['aksi'] == 'tambah') {

            //memanggil method insert
            $pelanggan->insert($id, $nama, $alamat, $jk, $tlp);

        } elseif ($_GET['aksi'] == 'update') {

            //memanggil method update
            $pelanggan->update($id, $nama, $alamat, $jk, $tlp);

        }
    }elseif ($_GET['aksi'] == 'hapus') {

            $id = $_GET['id'];

            $pelanggan->delete($id);
        }
    } 
    catch (Exception $e) {
        echo $e->getMessage();
    }


?>