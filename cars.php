<?php 
include("database/connect.php");
include("include/header.php"); 

?>



<?php

    if(isset($_POST['mainsearch'])){

    $selected=$_POST['localities'];
    $sql2="SELECT * FROM location WHERE town='".$selected."'";
    $query2=mysqli_query($conn, $sql2) or die ('Invalid query!');
    $resultz=mysqli_fetch_assoc($query2);
        $m=$resultz['locationid'];
    ?>
    <h1><center><?php echo "Hi, how is ".$selected."?<br>";?></center></h1>
    <?php
        $sql0="SELECT * from cars where state='1' and locationid ='".$m."'order by price";
        $query2=mysqli_query($conn, $sql0);
        $x=mysqli_num_rows($query2);?>
        <button type="button" class="btn btn-danger found" disabled>
            We have found <span class="badge badge-light"><?php echo $x; ?></span> (cars) for you!
        </button>
        
          <?php
		while($rowz=mysqli_fetch_assoc($query2)){
			?>
        <br><hr>
        <form class='carsdisplay' action='bookings.php' method='POST'>
            <?php
							    	$carid=$rowz['carid'];
							   		$pic=$rowz['picture']; 
									$com=$rowz['company'];
									$brand=$rowz['model'];
									$price=$rowz['price'];

									?>
                <input type="text" name="id" hidden value="<?php echo $carid; ?>">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <img id="pics" name="pic" src=<?php echo $pic; ?> >
                        </div>
                        <div class="col content">
                            <div class="card" style="width: 50rem; height: 95%;">
                                <div class="card-body">
                                    <h3 class="card-title">Here is a nice car! from <?php echo $com;?></h3><hr>
                                </div>
                                <table style="margin-left: 2%;"><ul class="list-group list-group-flush">
                                    <tr><td><li style="list-style: none; padding: 2%; font-size: 100%;font-family: cursive;">Company name:</td>
                                        <td><input style='border-style: none;font-size: 100%;font-family: cursive;' name='com' type='text' size=30 value='<?php echo $com; ?>' readonly>
                                    </li></td></tr>
                                    <tr><td><li style="list-style: none;  padding: 2%;font-size: 100%;font-family: cursive;">Car Model:</td>
                                        <td><input style='border-style: none;font-size: 100%;font-family: cursive;' name='brand' type='text' size=30 value='<?php echo $brand; ?>' readonly>
                                    </li></td></tr>
                                    <tr><td><li style="list-style: none;  padding: 2%;font-size: 120%;font-family: cursive;">Price:</td>
                                        <td><input style='border-style: none;font-size: 100%;font-family: cursive;' name='price' type='text' size=30 value='<?php echo $price; ?>' readonly>
                                    </li></td></tr>
                                </ul></table>
                                
                                <?php
										if(!isset ($_SESSION['email'])){?>
                                                <div class="card-body">
                                                <button class="btn btn-danger" disabled>To Book this
                                                <?php echo $brand; ?> , Kindly login</button>
                                                </div>
                                    <?php } else{?>
												
                                                 <div class="card-body">
                                                 <input type="submit" style="cursor: pointer;" class="btn btn-lg btn-primary" value="Book this <?php echo $brand; ?>">
                                                </div>
                                      <?php } ?>

                            </div>
                           
                        </div>
                    </div>
                </div>
             
        </form>
        <?php	} }
include("include/footer.php"); 
?>
