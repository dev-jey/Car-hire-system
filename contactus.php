<?php 
include("database/connect.php");
include("include/header.php");
?>
<?php

if(isset($_POST['submit'])){
     $name=$_POST['name'];
        $email=$_POST['email'];
        $subject=$_POST['subject'];
        $message=$_POST['message'];
        $sql="INSERT into feedback(Name, Email, Subject, Comment) values('$name','$email','$subject','$message')";
        $query=mysqli_query($conn, $sql);
}

?>
    <div class="row">
        <div class="contact-form col">
            <div class="feedback">
                <h3 class="section-title"><b>Give us your Feedback!</b></h3>
                <form class="form-group" action="#" method="POST" accept-charset="utf-8">
                    <input class="form-control" type="text" name="name" placeholder="Name" required>
                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                    <input class="form-control" type="text" name="subject" placeholder="Subject" required>
                    <textarea class="form-control" name="message" cols="50" rows="7" placeholder="Share your thoughts" required></textarea>
                    <input class="button btn-primary" type="submit" value="Send" id="submit" name="submit">
                </form>
            </div>
        </div>
        <div class="col">
            <div id='contact'>
                <h4 class='first'>Customer Service</h4>
                <p>
                    <hr>E-mail: <a href='www.jeycarhire@gmail.com'><i>jeycarhire@gmail.com</i></hr></a></p>
                <p>
                    <hr><b>Call or E-mail us for help with any issue concerning our car hire services</b></p>
                </hr>
                </p>
                <hr>Call telephone: <i>0708197333</i>
                <br>Call mobile <i>0708197333</i>
                <br>Office fax: <i>0708197333</i></hr>
                <br>
                <h4><hr>Mailing Addresses</hr></h4>
                <p>
                    <hr><i>250 Rongai, 4th Floor</i></hr>
                </p>
                <p>
                    <hr>Kajiado, Nairobi</hr>
                </p>
            </div>
        </div>
    </div>
    <?php

include("include/footer.php"); 
?>