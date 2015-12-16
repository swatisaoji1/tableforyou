
<div class="regContainer container"> 
    <h2>
        <?php
        if (isset($_SESSION['name'])) {
            echo $_SESSION['name'] . ", ";
        }

        if (isset($data['restaurant'])) {
            $restaurant = $data['restaurant'];
        }
        ?>
        Thank you for your reservations!</h2>
    <h4>We'll see you at <?php echo $data['restaurant']['Name'] ?></h4>
    <form action="<?php echo PUBLIC_ROOT . "restaurant/search" ?>" method="post">
        <input class="btn btn-danger" type="submit" value="Back to Search">
    </form>
    <hr>
    <div class="container">
        <div class="row col-sm-12">
            <div class="col-sm-4">
                <img src="<?php echo PUBLIC_ROOT . 'image/' . $data['restaurant']['Restaurant_Images_idRestaurant_Images'] ?>" hiegth="200" width="200"></img>
            </div> 
            <div class="col-sm-8">
                <h5>Your Reservation Details:</h5>
                <p><?php echo "Date:" . $_SESSION['choice']['date'] ?></p>
                <p><?php echo "Time:" . $_SESSION['choice']['time'] ?></p>
                <p><?php echo "Email:" . $_SESSION['Email'] ?></p>
                <p><?php echo "No of People:" . $_SESSION['choice']['people'] ?></p>

            </div> 
        </div>  
    </div>

    <h4>The confirmation email was sent to you</h4><br>
</div>


