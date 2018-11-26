<?php 
	include("database/connect.php");
	include("include/header.php");

	$getid=$_POST['getid'];
	$getname=$_POST['getname'];
	$getmodel=$_POST['getmodel'];
	$getprice=$_POST['getprice'];
	
	
	$sql="SELECT userid from users where email='".$_SESSION['email']."'";
	$result = mysqli_query($conn,$sql);
	while ($rows = mysqli_fetch_assoc($result)){ 
		$x=$rows['userid'];
	$sql2="INSERT into bookings (userid, carid) VALUES ('$x','$getid')";
	$res=mysqli_query($conn, $sql2);
	$sqlo="SELECT * from cars where carid='".$getid."'";
	$querry=mysqli_query($conn, $sqlo);
	$row=mysqli_fetch_assoc($querry);
	$sql3="UPDATE cars set state='0' where carid='".$getid."'";
	$query=mysqli_query($conn, $sql3);
?>
<div class="container-fluid bookingsmy">
<img src="images/back.jpg" alt="cars" style="height: 250px; width: 100%; opacity: 0.3"><hr>
<div class="centered">Receipt</div>
</div>
<div class="container-fluid receipt">
        <div class="card" style="width: 470px;">
            
            <div class="card-body">
                <h4 class="card-title">
            <b><center>Electronic Receipt<br>****</center></b></h4>
              <center><b><?php echo $_SESSION['email'];?></b><br></center>
                   <center>
                       <table>
                    <tr>You have successfully <br>booked a car with the<br> following descriptions<br></tr>
      					<tr><?php echo date("Y/m/d") . "<br>";?></tr>

                    <tr><td><body class="blockquote-footer">Company:</td>
                        <cite title="Source Title">
                          <td>  <?php echo $row['company']; ?></td></tr>
                        </cite>
                        <tr><td><br> Car Model:</td>
                        <cite title="Source Title">
                            <td><?php echo $row['model']; ?></td></tr>
                        </cite>
                        <tr><td><br> Price:</td>
                        <cite title="Source Title">
                            <td><?php echo "Ksh ".$row['price']; ?></td></tr></table>
                        </cite>
                        <p> <i>*Kindly pick up your car at your prefered date.</i></p>
                        <button class="btn btn-primary" onClick="window.print()">Print this Receipt</button></center>
                    </body>
            </blockquote>
        </div>
    </div>
</div>
<?php
	}
	include("include/footer.php")
	?>