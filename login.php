<?php 
include('includes/layout-header.php');

if(isset($_SESSION["userId"])){
    header("location: account.php");
    exit;
}

include('controllers/db.php');
include('controllers/passenger.php');

$database = new Database();
$db = $database->getConnection();

if(isset($_POST["sign-in-submit"])){
    $new_passenger = new Passenger($db);

    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $new_passenger->login($email, $password);
}
?>

<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <div class="w-100 bg-white shadow-sm p-3 login-form">
                    <div class="bg-primary p-3" style="background-image: linear-gradient(109.6deg, rgba(254,253,205,1) 11.2%, rgba(163,230,255,1) 91.1%);">
                        <h1 class="text-center">Login</h1>
                    </div>
                    <div class="p-3">
                        <?php
                            if(isset($_GET["signUp"])){
                                if($_GET["signUp"] == "passengerCreated"){
                                    echo '<div class="alert alert-success" role="alert">
                                    Account created successfully.
                                  </div>';
                                }
                            }else if(isset($_GET["newpwd"])){
                                if($_GET["newpwd"] == "passwordUpdated"){
                                    ?>
                                        <div class="alert alert-success" role="alert">
                                            Password updated successfully.
                                        </div>
                                    <?php
                                }
                            }else if(isset($_GET["signin"])){
                                if($_GET["signin"] == "fail"){
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            Invalid email or password.
                                        </div>
                                    <?php
                                }
                            }
                        ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggle-password">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <a href="forget-password.php">Forgot password?</a>
                            </div>
                            <button type="submit" class="btn btn-block btn-dark" name="sign-in-submit">Login</button>
                            <div class="text-center">
                                <span>Not registered yet? </span>
                                <a href="register.php">Create an account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="assets/img/plaza.jpg" alt="Description of image" class="rounded-circle img-fluid" style="width: 450px; height: 450px; object-fit: cover;" />
            </div>
        </div>
    </div>
</main>

<?php include('includes/scripts.php')?>
<?php include('includes/layout-footer.php')?>

<style>
    .login-form {
        max-width: 1500px;
        margin-left: -100px
    }
</style>

<script>
    document.getElementById('toggle-password').addEventListener('click', function (e) {
        var password = document.getElementById('password');
        var icon = e.target;
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
