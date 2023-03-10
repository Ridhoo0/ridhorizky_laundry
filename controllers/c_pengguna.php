<?php
include_once 'c_koneksi.php';

class c_pengguna
{

    public function insert($id, $nama, $username, $pass, $outlet, $role)
    {

        $conn = new c_koneksi();

        $sql = "INSERT INTO tb_user VALUES ('$id','$nama','$username','$pass', '$outlet', '$role')";

        $query = mysqli_query($conn->koneksi(), $sql);


        if ($query) {

            echo "<script>alert('Data Berhasil Ditambahkan');window.location='../views/pengguna/v_list_pengguna.php'</script>";
        } else {

            echo "data gagal ditambahkan";
        }
    }

    function tampil()
    {
        $conn = new c_koneksi();

        $sql = "SELECT tb_user.id, tb_user.nama AS user_nama, tb_user.username, tb_outlet.nama AS outlet_nama, tb_user.role FROM tb_user JOIN tb_outlet ON tb_user.id_outlet = tb_outlet.id ORDER BY tb_outlet.nama ASC";

        $query = mysqli_query($conn->koneksi(), $sql);

        while ($q = mysqli_fetch_object($query)) {

            $hasil[] = $q;
        }

        return $hasil;
    }

    function edit($id)
    {

        $conn = new c_koneksi();

        $sql = "SELECT tb_user.id, tb_user.nama AS user_nama, tb_user.username, tb_outlet.id AS outlet_id, tb_outlet.nama AS outlet_nama, tb_user.role FROM tb_user JOIN tb_outlet ON tb_user.id_outlet = tb_outlet.id WHERE tb_user.id=$id ";

        $query = mysqli_query($conn->koneksi(), $sql);


        while ($q = mysqli_fetch_object($query)) {

            $hasil[] = $q;
        }

        return $hasil;
    }

    function update($id, $nama, $username, $pass, $outlet, $role)
    {
        $conn = new c_koneksi();

        $sql = "UPDATE tb_user SET  nama='$nama', username='$username', password='$pass', id_outlet='$outlet', role='$role' WHERE id='$id'";
        // echo var_dump($sql);

        $query = mysqli_query($conn->koneksi(), $sql);


        if ($query) {

            echo "<script>alert('Data Berhasil Di Ubah');window.location='../views/pengguna/v_list_pengguna.php'</script>";
        } else {

            echo "data gagal diubah";
        }
    }

    function delete($id)
    {
        $conn = new c_koneksi();

        $query = "DELETE FROM tb_user WHERE id = $id";

        mysqli_query($conn->koneksi(), $query);

        header("location:../views/pengguna/v_list_pengguna.php");
    }
}
