<?php 
include("include/header.php"); 
include("database/connect.php");

?>
<?php
if(isset($_POST['register']))
{
  $name=$_POST['name'];
  $email=$_POST['email'];
  $gender=$_POST['gender'];
  $address2=$_POST['address2'];
  $city=$_POST['city'];
  $password=$_POST['password'];
  $password2=$_POST['password2'];

$sql= "SELECT email FROM users where email='".$email."'";
    $res = mysqli_query($conn,$sql);

 if($name && $password && $password2)
    {
        if(strlen($name)<30)
        {
            if(mysqli_num_rows($res)==0)
            {
                if(strlen(trim($password))<15 && strlen(trim($password))>6)
                {
                    if($password == $password2)
                    {
                        $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                          $sql = "INSERT INTO users (name, email, gender, address2, city, password)
                            VALUES ('$name','$email','$gender','$address2', '$city', '$hashpassword')";
                            $result = mysqli_query($conn,$sql);    
                        echo "<center><p style='color: red; font-style: all;'><b>Registration Complete!</b> <a href='login.php'>Click here to login</a></p></center>";
                    }
                    else
                    {
                        echo "<center><p style='color: red; font-style: all;'>*Passwords must match</p></center>";
                    }
                }
                else
                {
                    echo "<center><p style='color: red; font-style: all;'>*Your password must be between 6 to 15 characters</p></center>";   
                }
            }
        else{
            echo "<center><p style='color: red; font-style: all;'>*Email already in use</p></center>";
            }
        }
        else
        {
            echo "<center><p style='color: red; font-style: all;'>*Your name is too long</p></center>";
        }

}
}

?>
    <form id='registerform' method='POST' action='register.php'>
        <label>
            <h1><center>Register Here</center></h1></label>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="First Last" required>
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z0-9.-]{1,}[.]{1}[a-zA-Z0-9]{2,}" class="form-control" id="email" placeholder="name@email.something" required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Select Gender</label>
            <br>
            <input type='radio' name='gender' value='male' checked> Male
            <br>
            <input type='radio' name='gender' value='female'> Female
            <br>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Address</label>
                <input type="text" name="address2" class="form-control" id="address2" placeholder="Exact location" required>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>City</label>
            <input type="text" name="city" class="form-control" id="city" placeholder="City" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Password</label>
                <input type="Password" name="password" class="form-control" id="password" required>
            </div>
            <div class="form-group col-md-6">
                <label>Retype Password</label>
                <input type="Password" class="form-control" name="password2" id="password2" required>
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" required> Agree to terms & conditions
                </label>
            </div>
        </div>
        <input type="submit" name="register" class="btn btn-primary btn-lg" value="Sign Up">
    </form>
    <?php
  $conn->close();
include("include/footer.php"); 
?>