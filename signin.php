<?php
session_start();

if(isset($_POST['sign'])) {
    $email = isset($_POST['Email']) ? $_POST['Email'] : '';
    $password = isset($_POST['Password']) ? $_POST['Password'] : '';


    $conn = mysqli_connect("localhost", "root", "", "kwft");
    if(mysqli_connect_errno()) {
        die("Failed to connect: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare("SELECT * FROM employees WHERE Email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        if(password_verify($password, $data['Password'])) {
            $_SESSION['Email'] = $data['Email'];
            header('location:success.html');
        } else {
            $error[] = 'Invalid email or password.';
        }
    } else {
        $error[] = 'Invalid email or password.';
    }

    $stmt->close();
    mysqli_close($conn);
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="boxicons/css/boxicons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="main.css">
    <title>Employee Sign in</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p style="color: #e68000;">KWFT .</p>
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn"><a href="signin.php" style="text-decoration: none; color: inherit;">Log In</a></button>
            <button class="btn" id="registerBtn"><a href="index.php" style="text-decoration: none; color: inherit;">Register</a></button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<!----------------------------- Form container ----------------------------------->    
    <div class="form-box2">
        
        <!------------------- login form -------------------------->
        <form action="" method="post">
        <div class="login-container" id="login">
            <div class="top">
                <span>Don't have an account? <a href="index.php" >Register</a></span>
                <header>Login</header>
                      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span style="color:white;">'.$error.'</span>';
            }
         }
      ?>
            </div>
            <div class="input-box">
                <input type="email" class="input-field" name="Email" placeholder="Email Address">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="Password" placeholder="Password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Sign In" name="sign">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Forgot password?</a></label>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>   


<script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>

<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

</script>

</body>
</html>
