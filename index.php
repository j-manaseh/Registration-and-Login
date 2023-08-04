<?php
session_start();

if (isset($_POST['submit'])) {
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $email = isset($_POST['Email']) ? $_POST['Email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $title = isset($_POST['Title']) ? $_POST['Title'] : '';
    $department = isset($_POST['Department']) ? $_POST['Department'] : '';
    $staff_no = isset($_POST['snumber']) ? $_POST['snumber'] : '';
    $password = isset($_POST['Password']) ? $_POST['Password'] : '';
    $cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';
    $secure_pass = password_hash($password, PASSWORD_ARGON2I);

    if ($password === $cpassword) {
        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($phone) && !empty($title) && !empty($department) && !empty($staff_no) && !empty($password)) {
            $host = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbname = "kwft";

            // Creating connection
            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

            if (mysqli_connect_error()) {
                die('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
            } else {
                $SELECT = "SELECT Email FROM employees WHERE Email = ? LIMIT 1";
                $INSERT = "INSERT INTO employees (fname, lname, Email, phone, Title, Department, snumber, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                // Prepare statement
                $stmt = $conn->prepare($SELECT);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                $rnum = $stmt->num_rows;

                if ($rnum === 0) {
                    $stmt->close();
                    $stmt = $conn->prepare($INSERT);
                    $stmt->bind_param("sssissis", $fname, $lname, $email, $phone, $title, $department, $staff_no, $secure_pass);
                    if ($stmt->execute()) {
                        header('Location: signin.php');
                        exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                } else {
                    $error = 'This email is already registered.';
                }

                $stmt->close();
                $conn->close();
            }
        } else {
            $error = 'You are required to fill all fields';
        }
    } else {
        $error = 'Your Passwords Do Not Match';
    }
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
    <title>Employee Registration</title>
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
    <section>
    <div class="form-box">
        <!------------------- registration form -------------------------->
        <form action="" method="post">
        <div class="register-container" id="register">
            <div class="top">
                <span>Already have an account? <a href="signin.php">Login</a></span>
                <header>Register</header>
                      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span style="color:white;">'.$error.'</span>';
            }
         }
      ?>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="First Name" name="fname" pattern="[A-Za-z]+" title="Only letters are accepted" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Last Name" name="lname" pattern="[A-Za-z]+" title="Only letters are accepted" required>
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="email" class="input-field" placeholder="Email" name="Email" title="Please enter a valid email address (e.g., yourname@example.com)" required>
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="phone" name="phone" placeholder="Phone number" title="eg. 0712345678" class="input-field" required>
                    <i class='bx bx-phone'></i>
                </div>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Title" name="Title" title="Only letters are accepted" required>
                <i class="bx bx-user"></i>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Department" name="Department" pattern="[A-Za-z]+" title="Only letters are accepted" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="number" class="input-field" placeholder="Staff Number" name="snumber" pattern="[0-9]" title="Only numbers are accepted" required>
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="password" class="input-field" placeholder="Password" name="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#!~`$%^&*])[0-9a-zA-Z@#]{8,}" title="Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character (eg. @#!~`$%^&*)" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" placeholder="Confirm Password" name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#!~`$%^&*])[0-9a-zA-Z@#]{8,}" title="Must match the previous password field" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Register" name="submit">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Terms & conditions</a></label>
                </div>
            </div>
        </div>
        </form>
    </div>
    </section>
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
