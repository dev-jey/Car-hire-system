<?php 
include("database/connect.php");
include("include/header.php"); 


 if(isset($_POST['cancel'])){

    $id=$_POST['id'];
    $carid=$_POST['carid'];
    $com=$_POST['com'];
    $model=$_POST['model'];
    $price=$_POST['price'];

    $sql="DELETE from bookings where bookid='".$id."'";
    $query=mysqli_query($conn, $sql);
    $sql3="UPDATE cars set state='1' where carid='".$carid."'";
    $query2=mysqli_query($conn, $sql3); 
    header("location: mybookings.php");

    
}

else{?>

<div class="container-fluid bookingsmy">
<img src="images/back.jpg" alt="cars" style="height: 250px; width: 100%; opacity: 0.3"><hr>
<div class="centered"> My Bookings</div>
</div>
<?php

        $sql="SELECT userid from users where email='".$_SESSION['email']."'";
        $query=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($query)){
        $x=$row['userid'];
        $sql2="SELECT * from bookings where userid = '".$x."'";
        $query2=mysqli_query($conn, $sql2);
        $x=mysqli_num_rows($query2);

        if($x==0){?>
    <p style='background-color: white; opacity: 0.5; font-size: 200%; color: red; text-align: center; margin-left: 25%; width: 50%;'>You havent booked any car yet. Click <a href='index.php'>here </a> to book one!</p>
    <?php }
        else{
             while($rows=mysqli_fetch_assoc($query2)){
        $book=$rows['bookid'];
        $id=$rows['carid'];
        $user=$rows['userid'];
        $pickdate=$rows['pickdate'];
        $dropdate=$rows['dropdate'];
        $sql3="SELECT * from cars where carid='".$id."'";
        $quer=mysqli_query($conn, $sql3);
        $roww=mysqli_fetch_assoc($quer);
       
        ?>

        <form class='carsdisplay' action='mybookings.php' method='POST'>
    <input type="text" name="getid" hidden value="<?php echo $getid; ?>">
    <div class="container-fluid">
        <div class="row">
                                  <input type="text" name="id" hidden readonly value="<?php echo $book?>">
                                    <input type="text" readonly hidden name="carid" value="<?php echo $id; ?>">
                                    <input type="text" readonly hidden name="locationid" value="<?php echo $roww['locationid']; ?>">
            <div class="col">
                        <img id="pics" name="pic" src=<?php echo $roww['picture']; ?> >

                    </div>
            <div class="col">
                <div class="card" style="width: 50rem;">
                    <h4 class="card-title"><center>Car details</center></h4><br>
                    <ul class="list-group list-group-flush">
                        <li style="list-style: none; margin-left: 2%; font-size: 90%;font-family: cursive;">Company:
                            <input style='border-style: none;font-family: cursive;' type='text' name='com' value='<?php echo $roww['company'];?>' readonly>
                        Model:
                            <input style='border-style: none;font-family: cursive;' type='text' name='model' value='<?php echo $roww['model'];?>' readonly><br>
                        Price:
                            <input style='border-style: none;font-family: cursive;' type='text' name='price' value='<?php echo $roww['price'];?>' readonly>
                        </li>
                        <li class="list-group-item">Pick up date:
                            <input style='border-style: none;font-family: cursive;' type='text' name='price' value='<?php echo $pickdate;?>' readonly>
                        </li>
                        <li class="list-group-item">Drop off date:
                            <input style='border-style: none;font-family: cursive;' type='text' name='price' value='<?php echo $dropdate;?>' readonly>
                        </li>
                    </ul>
                   
                     <div class="card-footer text-muted">
                                <input type="submit" class="btn btn-primary" value="Cancel booking" name="cancel">
                            </div>
                </div>
            </div>
        </div>
    </div>
</form><hr>

   

  <?php }





      
    }
}
  
}

include("include/footer.php"); 
?>