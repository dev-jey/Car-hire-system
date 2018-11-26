<?php
include("database/connect.php");
include("include/header.php"); 

if(isset($_POST['submit'])){

	$id=$_POST['id'];
	$carid=$_POST['carid'];
	$com=$_POST['com'];
	$model=$_POST['model'];
	$price=$_POST['price'];
?>
<div class="container-fluid bookingsmy">
<img src="images/back.jpg" alt="cars" style="height: 250px; width: 100%; opacity: 0.3"><hr>
<div class="centered"> Cancel</div>
</div>
    <div class="container-fluid cancell">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Success</h4>
                <p class="card-text">You have successfully cancelled your booking</p>
                <a href="mybookings.php" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <?php


	$sql="DELETE from bookings where bookid='".$id."'";
	$query=mysqli_query($conn, $sql);
	$sql3="UPDATE cars set state='1' where carid='".$carid."'";
	$query2=mysqli_query($conn, $sql3);

	
}
include("include/footer.php"); 
?>