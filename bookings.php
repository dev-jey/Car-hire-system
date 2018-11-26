<?php 
	include("database/connect.php");
	include("include/header.php");




    if(isset($_POST['bookk'])){



    $getid=$_POST['getid'];
    $getname=$_POST['getname'];
    $getmodel=$_POST['getmodel'];
    $getprice=$_POST['getprice'];
    $enternumber=$_POST['enternumber'];
    $enterid=$_POST['enterid'];
    $pickdate=$_POST['pickupdate'];
    $dropdate=$_POST['dropoffdate'];
    
    $sql="SELECT userid from users where email='".$_SESSION['email']."'";
    $result = mysqli_query($conn,$sql);

    while ($rows = mysqli_fetch_assoc($result)){ 
        $x=$rows['userid'];
    $sql2="INSERT into bookings (userid, carid, pnumber, id, pickdate, dropdate) VALUES ('$x','$getid', '$enternumber', '$enterid','$pickdate', '$dropdate')";
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
        <div class="card">
       
            <div class="card-body">
                <h4 class="card-title">
            <b><center>Electronic Receipt<br>****</center></b></h4>
              <center><b><?php echo $_SESSION['email'];?></b><br></center>
                   <center>
                       <table>
                    <tr>You have successfully booked a car with the<br> following descriptions<br></tr>
                    <tr>Phone Number: <?php echo $enternumber;?></tr><br> 
                    <tr>ID: <?php echo $enterid;?></tr><br>
                    <tr>Pick Up date: <?php echo $pickdate;?></tr><br>
                    <tr>Drop off date: <?php echo $dropdate;?></tr>
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
                            <td><?php echo "Ksh ".$row['price']; ?></td></tr>
                        </table>
                        </cite>

                        <p> <i>*Kindly pick up your car at your prefered date.</i></p>
                        <?php echo date("Y/m/d") . "<br>";?>
                        <button class="btn btn-primary" onClick="window.print()">Print this Receipt</button></center>
                    </body>
            </blockquote>
        </div>
    </div>
</div>
 <?php   }




}else{

    $getid=$_POST['id'];
    $getname=$_POST['com'];
    $getmodel=$_POST['brand'];
    $getprice=$_POST['price'];

    $sql21="SELECT picture from cars where carid='".$getid."'";
    $que=mysqli_query($conn, $sql21);
    $r=mysqli_fetch_assoc($que);

    $pic=$r['picture'];

?>
<div class="container-fluid bookingsmy">
<img src="images/back.jpg" alt="cars" style="height: 250px; width: 100%; opacity: 0.3"><hr>
<div class="centered">Bookings</div>
</div>

<form class='carsdisplay' action='bookings.php' method='POST'>
    <input type="text" name="getid" hidden value="<?php echo $getid; ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                        <img id="pics" name="pic" src=<?php echo $pic; ?> >

                    </div>
            <div class="col">
                <div class="card" style="width: 50rem;">
                    <div class="card-body">
                        <h4 class="card-title">You are about to book this <?php echo $getmodel;?></h4>
                        <p class="card-text">Please ensure the car details and price are correct</p>
                    </div>

                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">*Pick-up Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="date" name="pickupdate" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;
                         *Drop-Off Date:
                            <input type="date" name="dropoffdate" required>
                        </li>
                        <li class="list-group-item">
                            *Enter your mobile number:
                            <input type='number' name="enternumber" required>
                            *Enter your id number:
                            <input type='number' name="enterid" required>
                        </li>

                        <li style="list-style: none; margin-left: 2%; font-size: 90%;font-family: cursive;">Car Name:
                            <input style='border-style: none;font-family: cursive;' type='text' name='getname' value='<?php echo $getname;?>' readonly></li>
                        <li style="list-style: none; margin-left: 2%; font-size: 90%;font-family: cursive;">Model:
                            <input style='border-style: none;font-family: cursive;' type='text' name='getmodel' value='<?php echo $getmodel;?>' readonly></li>
                        <li style="list-style: none; margin-left: 2%; font-size: 90%;font-family: cursive;">Price:
                            <input style='border-style: none;font-family: cursive;' type='text' name='getprice' value='<?php echo $getprice;?>' readonly>
                        </li>
                    </ul>
                    <div class="card-body">
                        <input type="submit" name='bookk' class="btn btn-lg btn-primary" value="Confirm booking" style="cursor: pointer;">
                        <a href="index.php" class="btn btn-primary btn-lg" name='cancel' value="cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form><hr>
<?php
}

include("include/footer.php");
?>