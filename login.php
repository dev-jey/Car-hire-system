<?php 
include("include/header.php"); 
include("database/connect.php");

if (isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
   

    $sql= "SELECT email, password FROM users WHERE email= '".$email."'";
    $result = mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    $pass=$row['password'];

    $passwordCorrect = password_verify($password, $pass);

    $sqladmin="SELECT role from users where email='".$email."'";
    $queryadmin=mysqli_query($conn, $sqladmin);
    $rowadmin=mysqli_fetch_assoc($queryadmin);

    $role=$rowadmin['role'];


    if($passwordCorrect) 
    {
      
    $_SESSION["email"]=$email; 
    if($role==1){
        echo " <center><p style='color: blue; font-style: all;'>Success! </p></center> <script>window.location = 'index.php'</script>";   
    }
    else{
        echo " <center><p style='color: blue; font-style: all;'>Success! </p></center> <script>window.location = 'admin/dashboard.php'</script>";
    }
    }
    else 
    {
      echo "<center><p style='color: red; font-style: all;'>Check credentials! </p></center>";
    }

}
?>
<form class="loginform" action="login.php" method="POST">
    <div class="form-group">
        <label>Email address</label>
        <input type="email" class="form-control" id="login" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">Your details are safe</small>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="login" name="password" placeholder="Password">
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input"> Keep me logged in
        </label>
    </div>
    <button type="submit" class="btn btn-primary" name="login">Submit</button>
    <a href='register.php'><img src='images/here.png' style='width: 20px; height: 20px; float: right;' alt ='here'></a>
    <p style="float: right;">New User?Click </p>
</form>
<?php
include("include/footer.php"); 

?>