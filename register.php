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

    if(isset($_POST["sign-up-submit"])){
        $new_passenger = new Passenger($db);
        
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $password = $_POST["password"];

        $new_passenger->create($first_name, $last_name, $email, $address, $password);
    }
?>

<main>
    <div class="container mt-3">
        <div class="w-100 m-auto bg-white shadow-sm" style="max-width: 500px">
            <div class="bg-primary p-3" style="background-image: linear-gradient( 109.6deg,  rgba(254,253,205,1) 11.2%, rgba(163,230,255,1) 91.1% );">
                <h1 class="text-center">Create an Account</h1>
            </div>

            <div class="p-3">
                <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "emailExist"){
                            echo '<div class="alert alert-danger" role="alert">
                            Email already exist.
                          </div>';
                        }else if($_GET["error"] == "stmtfailed"){
                            echo '<div class="alert alert-danger" role="alert">
                            Error on creating an account.
                          </div>';
                        }
                    }
                ?>

                <form method="POST" action="">
                    <div class="form-row mb-3">
                        <div class="col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required />
                        </div>
                        <div class="col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required />
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" id="toggle-password">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required />
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" id="toggle-confirm-password">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block glow-button" name="sign-up-submit">Register</button>

                    <div class="text-center">
                        <span>Already have an account? </span>
                        <a href="login.php">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('includes/scripts.php')?>
<?php include('includes/layout-footer.php')?>

<script>
    document.querySelectorAll('.toggle-password').forEach(function(icon) {
        icon.addEventListener('click', function(e) {
            var passwordField = (icon.id === 'toggle-password') ? document.getElementById('password') : document.getElementById('confirm_password');
            var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            icon.querySelector('i').classList.toggle('fa-eye');
            icon.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.glow-button {
  position: relative;
  padding: 10px 20px;
  font-size: 16px;
  color: white;
  background-image: linear-gradient( 68.6deg,  rgba(79,183,131,1) 14.4%, rgba(254,235,151,1) 92.7% );
  border: none;
  border-radius: 5px;
  cursor: pointer;
  outline: none;
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.glow-button:hover {
  box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
}

.glow-button:focus {
  box-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
}
</style>
