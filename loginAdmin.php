<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: menuAdmin.php");
        } else {
            $error = "Password anda salah";
        }
    } else {
        $error = "Username tidak ditemukan";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center" style="font-size: 32px;"><b>Login </b>Admin</div>
                <div class="card-body">
                    <p class="login-box-msg" style="text-align: center;">Sign in</p>
                    <form method="POST" action="index.php?page=loginAdmin">
                        <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                        }
                        ?>
                        <div class="form-group">
                            <label for="username"><b>Username</b></label>
                            <input type="text" name="username" class="form-control" placeholder="Input Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><b>Password</b></label>
                            <input type="password" name="password" class="form-control" placeholder="Input Password" required>
                        </div>
                        <div class="text-center" style="line-height: 60px;">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="mt-3">Belum punya akun? <a href="index.php?page=registerAdmin"><b>Register</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>