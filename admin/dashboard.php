<?php 
include("include/header.php");
include("database/connect.php");


//check whether there is a logged in user 

if(isset($_SESSION['email'])){
 ?>
<div class="row">
    <div class="col">
        <form class="adminform" method="POST" action="dashboard.php" style="
    border-style: inset;
    padding: 40px;
    width: 25%;
    position: fixed;
    margin-left: 5%;
">
            <?php 

    //admin portal form

    echo "<h3 style='color:green;'>Welcome Administrator</h3><hr>";?>
            <input class="btn btn-info" type="submit" name="viewusers" value="View users" style="cursor: pointer;">
            <br>
            <hr>
            <input class="btn btn-info" type="submit" name="addcar" value="Add Cars" style="cursor: pointer;">
            <br>
            <hr>
            <input class="btn btn-info" type="submit" name="viewcars" value="View all cars" style="cursor: pointer;">
            <br>
            <hr>
            <input class="btn btn-info" type="submit" name="viewbooked" value="View booked cars" style="cursor: pointer;">
            <br>
            <hr>
            <input class="btn btn-info" type="submit" name="addlocation" value="Add location" style="cursor: pointer;">
            <br>
            <hr>
            <input class="btn btn-info" type="submit" name="viewfeedback" value="View Customer Feedback" style="cursor: pointer;">
            <br>
            <hr>
        </form>
    </div>
    <div class="col" style="margin-right: 6%;">
        <?php

//View all users

if(isset($_POST['viewusers'])){

    $sqlst="SELECT * from users";
    $queryst=mysqli_query($conn, $sqlst);
        while ($rowst=mysqli_fetch_assoc($queryst)){

        $name=$rowst['name'];
        $email=$rowst['email'];
        $gender=$rowst['gender'];
        $address=$rowst['address2'];
        $city=$rowst['city'];
        $role=$rowst['role'];
        ?>
            <form action="dashboard.php" method="POST">
                <table>
                    <tr>
                        <td style="border-style:inset; min-width: 100px;">
                            <?php echo $name; ?>
                        </td>
                        <td style="border-style:inset; min-width: 100px;">
                            <input type="text" readonly name="email" value=<?php echo $email; ?>></td>
                        <td style="border-style:inset; min-width: 50px;">
                            <?php echo $gender; ?> </td>
                        <td style="border-style:inset; min-width: 100px;">
                            <?php echo $address; ?>
                        </td>
                        <td style="border-style:inset; min-width: 100px;">
                            <?php echo $city; ?>
                        </td>
                        <?php
      if($role=='0'){ ?>
                            <td style="border-style:inset; width: 50px; min-width: 70px;">
                                <?php echo "Admin"; ?>
                            </td>
                            <?php }
        else{ ?>
                            <td style="border-style:inset; width: 50px; min-width: 70px;">
                                <?php echo "Normal user"; ?>
                            </td>
                            <?php  } ?>
                            <td>
                                <input type="submit" class="btn btn-primary" name="changerole" value="ChangeRole" style="padding: 10px;">
                            </td>
                            <td>
                                <input type="submit" class="btn btn-primary" name="deleteuser" value="Delete User" style="padding: 10px;">
                            </td>
                    </tr>
                </table>
            </form>
            <?php }
}
?>
            <?php

//Change a user's role

        if (isset($_POST['changerole'])) {
            
            $email=$_POST['email'];
            $sqls="SELECT * from users where email='".$email."'";
            $querys=mysqli_query($conn, $sqls);
            while ($rowz=mysqli_fetch_assoc($querys)){
                $role=$rowz['role'];
                $email=$rowz['email'];
                //check if he is already an admin
                if($role=='1'){


                    //change role of the normal user from 1 to 0

                    $sql="UPDATE users SET role='0' where email='".$email."'";
                    mysqli_query($conn, $sql);
                    echo "<p style='color:red;'>".$email." Has been made an admin!</p>";
                }
                else{ 
                    
                    $sql="UPDATE users SET role='1' where email='".$email."'";
                    mysqli_query($conn, $sql);
                    echo "<p style='color:red;'>".$email." Has been made an normal user!</p>";
                }
            }
                
                
        }
//Delete user
            if (isset($_POST['deleteuser'])) {
            $email2=$_POST['email'];
            $deletesql="DELETE from users where email='".$email2."'";
            $querydel=mysqli_query($conn, $deletesql);
            echo "<p style='color:red;'>User has been deleted!</p>";
            }
        

//ADD CARS BUTTON
?>
                <?php

    //check whether the addcar button is pressed

        if(isset($_POST['addcar'])){  ?>
                    <form action="dashboard.php" method="POST" style="
                     width: 80%;
                    padding: 60px;
                    background-color: white;">
                        <?php echo "Enter the car's details below<br><hr>"; ?>
                        <input type="text" required name="carpicture" placeholder="Enter the link of the image" size=50 style="padding: 10px; margin-bottom: 20px;">
                        <br>
                        <input type="text" required name="company" placeholder="Enter the car company" size=50 style="padding: 10px; margin-bottom: 20px;">
                        <br>
                        <input type="text" required name="locationid" placeholder="Enter the car location id" size=50 style="padding: 10px; margin-bottom: 20px;">
                        <br>
                        <input type="text" required name="model" placeholder="Enter the car model" size=50 style="padding: 10px; margin-bottom: 20px;">
                        <br>
                        <input type="text" required name="price" placeholder="enter the car's Price" size=50 style="padding: 10px; margin-bottom: 20px;">
                        <br>
                        <input type="submit" class="btn btn-primary" required name="addthiscar" value="Add this Car" style="padding: 7px 40px; margin-bottom: 20px;"> </form>
                    <?php
            }

            //tasks to do once all the details are entered

            if(isset($_POST['addthiscar'])){

                $picture=$_POST['carpicture'];
                $company=$_POST['company'];
                $locationid=$_POST['locationid'];
                $model=$_POST['model'];
                $price=$_POST['price'];

                $sqlinsert="INSERT INTO cars(picture,company,locationid,model,price) VALUES('$picture','$company','$locationid','$model','$price')";
                mysqli_query($conn, $sqlinsert);

                echo "Success";

            }

?>
                        <?php
//VIEW ALL CARS BUTTON
        
        if(isset($_POST['viewcars'])){

            //select all cars from db

            $sqlm="SELECT * from cars";
            $que=mysqli_query($conn, $sqlm);
            while($rows=mysqli_fetch_assoc($que)){ 
                $id=$rows['carid'];
                $pic=$rows['picture'];
                $com=$rows['company'];
                $brand=$rows['model'];
                $price=$rows['price'];

                //display the cars in an orderly manner

                ?>
                            <form action="dashboard.php" method="POST">
                                <table>
                                    <tr>
                                        <input type="text" name="id" readonly hidden value=<?php echo $id; ?>>
                                        <td style="border-style:inset; min-width: 80px;"><img style="width: 4em;" class="pic" src="<?php echo $pic; ?>"></td>
                                        <td style="border-style:inset; width: 150px; min-width: 200px;">
                                            <input type="text" name="com" readonly  value=<?php echo $com; ?>>
                                        </td>
                                        <td style="border-style:inset; width: 150px; min-width: 150px;">
                                            <input type="text" name="brand" readonly value=<?php echo $brand; ?>> </td>
                                        <td style="border-style:inset; width: 150px; min-width: 150px;">
                                            <input type="text" name="price" readonly value=<?php echo $price; ?>>
                                        </td>
                                        <td style="border-style:inset; width: 150px; min-width: 100px;">
                                            <input class="btn btn-primary" readonly type="submit" name="updatecar" value="Update Car"  style="cursor: pointer;">
                                        </td>
                                        <td style="border-style:inset; width: 150px; min-width: 100px;">
                                            <input class="btn btn-primary" readonly type="submit" name="deletecar" value="Delete Car"  style="cursor: pointer;"> </td>
                                    </tr>
                                </table>
                            </form>
                            <?php }
        }


?>


<?php
//Update car details

if (isset($_POST['updatecar'])) {

    $id=$_POST['id'];
    $com=$_POST['com'];
    $brand=$_POST['brand'];
    $price=$_POST['price'];


     ?>
     <form action="dashboard.php" method="POST">
     <h3>Car Details</h3>
     <input type="text" hidden name="id2" value="id">
    Company: <input type="text" size= 30 required name="com2" value="<?php echo $com; ?>"><br>
    Brand: <input type="text" size=30 required name="brand2" value="<?php echo $brand; ?>"><br>
    Price: <input type="text" size=30 required name="price2" value="<?php echo $price; ?>"><br>
    <input type="submit" name="update" value="update">
</form>
 <?php   
}
?>


<?php

//update button


if (isset($_POST['update'])) {

$id2=$_POST['id2'];
$com2=$_POST['com2'];
$brand2=$_POST['brand2'];
$price2=$_POST['price2'];
   

    $s="UPDATE cars set company='$com2', model='$brand2', price='$price2' WHERE carid='$id2'";
    mysqli_query($conn, $s);
     echo "<p style='color:red;'>Car has been altered successfully!</p>";
}

?>

<?php

//Delete car

if (isset($_POST['deletecar'])) {
    $id=$_POST['id'];

    $deletecar="DELETE from cars where carid='".$id."'";
            mysqli_query($conn, $deletecar);
            echo "<p style='color:red;'>Car has been deleted!</p>";
}
?>





 <?php

    //VIEW BOOKED CARS BUTTON

if(isset($_POST['viewbooked'])){

        //select all values from bookings table
    
        $sql6="SELECT * from bookings";
        $res=mysqli_query($conn, $sql6);
        while ($rowe=mysqli_fetch_assoc($res)) {
            $carid=$rowe['carid'];
            $userid=$rowe['userid'];
            $number=$rowe['pnumber'];
            $id=$rowe['id'];
            $pickdate=$rowe['pickdate'];
            $dropdate=$rowe['dropdate'];

            //take emails of people who have booked cars

            $sql5="SELECT email from users where userid='".$userid."'";
            $query5=mysqli_query($conn, $sql5);
            $r=mysqli_fetch_assoc($query5);

            $email= $r['email'];

            //select car details of booked cars

            $sql3="SELECT * from cars where carid='".$carid."'";
            $query3=mysqli_query($conn, $sql3);
            while($rowes=mysqli_fetch_assoc($query3)){
                $pic=$rowes['picture'];
                $com=$rowes['company'];
                $brand=$rowes['model'];
                $price=$rowes['price'];
        
                //display all booked cars


        ?>
                                <form action="dashboard.php" method="POST">
                                    <table>
                                        <tr>
                                            <td style="border-style:inset; min-width: 70px;"><img style="width: 4em;" class="pic" src="<?php echo $pic; ?>"></td>
                                           <td style="border-style:inset; width: 80px; min-width: 100px;">
                                                <?php echo $number; ?>
                                            </td>
                                             <td style="border-style:inset; width: 80px; min-width: 100px;">
                                                <?php echo $id; ?>
                                            </td>
                                            <td style="border-style:inset; width: 150px; min-width: 150px;">
                                                <?php echo $com; ?>
                                            </td>
                                            
                                             <td style="border-style:inset; width: 80px; min-width: 100px;">
                                                <?php echo $email; ?>
                                            </td>
                                            <td style="border-style:inset; width: 70px; min-width: 80px;">
                                                <?php echo $brand; ?> </td>
                                            <td style="border-style:inset; width: 70px; min-width: 70px;">
                                                <?php echo $price; ?>
                                            </td>
                                            <td style="border-style:inset; width: 100px; min-width: 100px;">
                                                <?php echo $pickdate; ?>
                                            </td>
                                            <td style="border-style:inset; width: 100px; min-width: 100px;">
                                                <?php echo $dropdate; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <?php

    }   
        }
        }
    
?>
                                <?php
//INSERT LOCATION BUTTON

        if(isset($_POST['addlocation'])){  ?>
                                    <form action="dashboard.php" method="POST" style="
                                    width: 80%;
                                     padding: 60px;
                                    background-color: white;">
                                        <?php echo "Enter the Locations' details below<br><hr><br>"; ?>
                                        <input type="text" name="town" size=30 placeholder="Enter the town name" required style="padding: 10px; margin-bottom: 20px;">
                                        <br>
                                        <textarea type="text" name="description" required placeholder="Enter a bit of description" rows="8" cols="60" style="padding: 10px 10px; margin-bottom: 20px;"></textarea>
                                        <br>
                                        <input type="submit" class="btn btn-primary" name="addnewlocation" value="Add this new Location" style="padding: 10px 100px; margin-bottom: 20px;">
                                    </form>
                                    <?php
            }

            //tasks to do once all the details are entered

            if(isset($_POST['addnewlocation'])){
                $town=$_POST['town'];
                $description=$_POST['description'];
                $sqloc="INSERT INTO location(town,description) VALUES('$town','$description')";
                mysqli_query($conn, $sqloc);

                echo "Success";

            }

?>
                                        <?php
//VIEW CUSTOMER FEEDBACK BUTTON
    
        if(isset($_POST['viewfeedback'])){

            $sqle="SELECT * from feedback";
            $query2=mysqli_query($conn, $sqle); ?>
                                            <?php
            while ($ro=mysqli_fetch_assoc($query2)) {
                $name=$ro['Name'];
                $email=$ro['Email'];
                $subject=$ro['Subject'];
                $comment=$ro['Comment'];
            

            ?>
                                                <form action="dashboard.php" method="POST">
                                                    <table>
                                                        <tr>
                                                            <td style="border-style:inset; min-width: 100px;">
                                                                <?php echo $name; ?>
                                                            </td>
                                                            <td style="border-style:inset; min-width: 200px;">
                                                                <?php echo $email; ?>
                                                            </td>
                                                            <td style="border-style:inset; min-width: 150px;">
                                                                <?php echo $subject; ?> </td>
                                                            <td style="border-style:inset; min-width: 400px;  ">
                                                                <?php echo $comment; ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                <?php

        }


}

?>
    </div>
</div>
<?php } 


include("include/footer.php");
 ?>