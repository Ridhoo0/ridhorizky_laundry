<?php

session_start();

include_once 'c_koneksi.php';

class c_login
{

    public function login_role($username = null, $password = null)
    {

        $conn = new c_koneksi();

        if (isset($_POST['login'])) {

            $sql = "SELECT * FROM tb_user WHERE username='$username'";

            $query = mysqli_query($conn->koneksi(), $sql);

            $data = mysqli_fetch_assoc($query);

            if ($data) {
                if (password_verify($password, $data['password'])) {

                    if ($data['role'] == 'admin') {

                        $_SESSION["data"] = $data;

                        header("Location: ../views/home/v_home_admin.php");
                        exit;
                    } else if ($data['role'] == 'owner') {

                        $_SESSION["data"] = $data;

                        
                        header("Location: ../views/home/v_home_owner.php");

                        exit;
                    } else if ($data['role'] == 'kasir') {

                        $_SESSION["data"] = $data;

                        header("Location: ../views/home/v_home_kasir.php");

                        exit;
                    }
                } else {

                    echo "<script>alert('Login Gagal !!! Silahkan cek Username dan Password');window.location='index.php'</script>";
                }
            }
        }
    }


    public function logout()
    {

        session_destroy();
        header("location: ../index.php");
        exit;
    }
}
?>