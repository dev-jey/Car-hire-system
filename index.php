<?php 
include("database/connect.php");
include("include/header.php");
 ?>

<div class="card text-center text-white bg-dark selection">
    <div class="card-body">
        <form class='location' action="cars.php" method="POST">
            <?php
                $query = 'SELECT * FROM location';
                $results = mysqli_query($conn,$query);
                ?>
                <select name='localities'>
                    <?php
                        while ($rows = mysqli_fetch_assoc($results)){ 
                         ?>
                        <option value="<?php echo $rows['town'];?>">
                            <?php echo $rows['town']; ?> </option>
                        <?php
                             }
                       ?>
                </select>
                <input type="submit" name="mainsearch" value="Search Cars Near You!">
        </form>
    </div>
</div>
<hr>
<div id="slideshow" class="carousel slide" data-interval="10000" data-keyboard="true" data-pause="hover" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#slideshow" data-slide-to="0" class="active"></li>
        <li data-target="#slideshow" data-slide-to="1"></li>
        <li data-target="#slideshow" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block" src="images/hdcar.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <div class="texty" style="font-family: cursive;color: black;">
                    <label style="font-size: 20px; font-family: all; text-align: center; ">Hello there!
                        <br><i>"Welcome to the best car hire company in kenya so far. We have different packages, well crafted to satisfy your travelling needs. Just select your location, and then coose from a wide variety of pocket friendly car prices."</i>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </label>
                </div>
                <br>
                <a href="about.php" name="submit" class="btn btn-primary btn-lg">Read more about us</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block" src="images/lambo.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <div class="texty" style="font-family: cursive;color: black;">
                    <label style="font-size: 20px; font-family: all;text-align: center;">Welcome buddy!
                        <br><i>"We have the best services. We assure quality for any of your needs. We are focused on making our clients happy.Just feel free to communicate incase you face any trouble"</i>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </label>
                </div>
                <br><a href="about.php" name="submit" class="btn btn-primary btn-lg">Read more about us</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block" src="images/sportscar.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <div class="texty" style="font-family: cursive;color: black;">
                    <label style="font-size: 20px; font-family: all;text-align: center;">Perfection!
                        <br><i>"Sitback and relax, we've got all your transport needs. We offer the most secure framework to book a car, and our affiliate companies are registered and dependable. You can't find better services anywhere"</i>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </label>
                </div>
                <br><a href="about.php" name="submit" class="btn btn-primary btn-lg">Read more about us</a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#slideshow" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
        <a class="carousel-control-next" href="#slideshow" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
    </div>
</div>
</body>
<?php

include("include/footer.php"); 

?>