<?php

class c_koneksi{

    function koneksi(){

        $conn = mysqli_connect('localhost','root','','laundry_kel11');

        // return $conn;

        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }else{
            return $conn;
        }
    }
}

?>