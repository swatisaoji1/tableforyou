<?php
$days = array( '1' => "MONDAY", '2' => "TUESDAY",'3' => "WEDNESDAY",'4' => "THURSDAY",
               '5' => "FRIDAY", '6' => "SATURDAY",'0' => "SUNDAY");
$open_hours = $data['hours'];     
function is_admin() {
    if (isset($_SESSION['User_type']) && $_SESSION['User_type'] == "4") {
        return true;
    }
    return false;
}
?>

<input type="hidden" id="t4u_hideimage" value="<?php echo PUBLIC_ROOT . 'img/calendar112.png' ?>"/>
<div class="container-fluid">
    <?php if (!is_admin()) { ?>
        <form action="<?php echo PUBLIC_ROOT . "restaurant/search" ?>" method="post">
            <input class="btn btn-danger" type="submit" value=" < ">
            <input class="btn-link" type="submit" value="Back to Search">          
        </form>
    
    <?php } ?>


    <div class="row t4u_detail_header_background">
        <div class="t4u_detail_header">
            <div class="col-md-2">
                <img src="<?php echo PUBLIC_ROOT . 'image/' . $data['Restaurant_Images_idRestaurant_Images'] ?>" 
                     alt="" class="img-responsive"/>
            </div>
            <div class="col-md-10">
                <!--<div class="row t4u_detail_name_row">
                    <div class="col-md-12"><?php echo $data['Name'] ?></div>
                </div>-->
                <div class="row t4u_detail_name_row">
                    <h3><?php echo $data['Name'] ?></h3>
                </div>
                <div class="row t4u_detail_address_row h4">
                    <div class="col-md-10">
                        <?php echo $data['Address'] ?>
                    </div>
                    <div class="col-md-2">
                        <?php if (is_admin()) { ?>
                            <?php if ($data['Approved'] == 0) { ?>
                                <a href="<?php echo PUBLIC_ROOT . 'restaurant/approve/' . $data['idRestaurants'] ?>" class="btn btn-danger">Approve</a>
                            <?php } else { ?>
                                <a class="btn btn-success">Approved<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="row t4u_detail_address_row h4">
                    <div class="col-md-12">
                        <?php
                        $phone_number = str_replace("-", '', $data['Phone']);
                        echo substr($phone_number, 0, 3) . "-" . substr($phone_number, 3, 3) . "-" . substr($phone_number, 6, 4);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding:0">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img class="first-slide" src="http://howlmag.com/wp-content/uploads/finedining.jpg">
                </div>

                <div class="item">
                    <img class="second-slide" src="https://bearwife.files.wordpress.com/2010/10/20080222011246_fine252520dining255b1255d.jpg">
                </div>

                <div class="item">
                    <img class="third-slide" src="http://lolleroll.files.wordpress.com/2015/03/wpid-1180178.jpg">
                </div>

                <div class="item">
                    <img class="fourth-slide" src="https://richardkenworthy.files.wordpress.com/2012/06/img_3877-edit.jpg">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <?php if (!is_admin()) { ?>
        <div class="row t4u_details_reservation_bar">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-inline" role="form" action="<?php echo PUBLIC_ROOT . "restaurant/book_table/" . $data['idRestaurants'] ?>" method="post">
                    <select class="form-control" name="people" required="required">
                        <option value="" disabled selected>People</option>
                        <option>2 people</option>
                        <option>3 people</option>
                        <option>4 people</option>
                        <option>5 people</option>
                        <option>6 people</option>
                        <option>7 people</option>
                        <option>8 people</option>
                    </select> 
                    <select class="form-control t4u_openhour" name="time" openhour='<?php echo $data['Start_Time'] ?>' closehour='<?php echo $data['Close_Time'] ?>' required="required">
                        <option value="" disabled selected>Time</option>
                    </select>  
                    <input class="form-control t4u_cal" type="text" name="date" placeholder="Date" required="required">

        <!--<input class="calendar" id="datepicker <?php //echo date('m/d/Y');   ?>">-->
                    <button class ="btn btn-danger" type="submit"  value="book table" name="submit">Reserve</button>
                </form>
            </div>
        </div>
    <?php } ?>
    <div class="row menu_details">
        <ul class="nav nav-tabs nav-justified menu">
            <li><a href="#descriptionHeader">Description</a></li>
            <li><a href="#Hours">Open Hours</a></li>
            <li><a href="#directionHeader">Directions</a></li>
            <?php if (!is_admin()) { ?>
                <li>
                    <a href="#reviewHeading">Review</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!--<div class="row navigation">        
        <ul class="menu">
          <li><a href="http://www.beyondmenu.com/29563/concord/swagat-indian-cuisine-concord-94520.aspx" target="_blank">Menu</a></li>
          <li><a href="#directionHeader">Directions</a></li>
          <li><a href="#reviewHeading">Review</a></li>
        </ul>      
   </div>-->
    <div id="descriptionHeader" class="row">
        <h3 class="review">Here's what we are about</h3>
        <h4 class="descriptionDetails">
           <?php echo $data['Description']?>
        </h4>
    </div>
    
     <div id="Hours" class="row">
        <h3 class="review">Open Hours</h3>
        <div class="container">
        <h4 class="descriptionDetails">
            <table class="table table-striped">
                <tr>
                    <th>Days</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
                 <?php
                    foreach ($open_hours as $row) {
                 ?>
                 <tr>
                    <td>
                        <?php
                            echo $days[$row['Day_of_week']];
                        ?>
                    </td>
                    <td>
                        <?php
                        $t = strtotime($row['Start_Time']);
                        echo date('h:i A', $t);
                        ?>
                    </td>
                    <td>
                        <?php
                        $t = strtotime($row['Close_Time']);
                        echo date('h:i A', $t);
                        ?>
                    </td>
                 </tr>
                <?php
                    }
                ?>
            </table>
        </h4>
        </div>
    </div>
    
    <div id="directionHeader" class="row">
        <H3 class="review">Maps and direction</H3>
        <div class='col-sm-2'></div>
        <div class="col-sm-8">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" align="center"
                        src="https://maps.google.it/maps?q=<?php echo $data['Address']; ?>&output=embed"                        
                        align="center" id="mapthumbnail">           
                </iframe>    
            </div>
        </div>
        <div class='col-sm-2'></div>
    </div>
    <?php if (!is_admin()) { ?>
        <div class="row">
            <div class="review" id="reviewHeading"><p>Reviews</p></div>      
            <div class="container">
            <div class="reviewText">
                <?php
                $reviews = $data['reviews'];
                if (!empty($reviews)) {
                    foreach ($reviews as $item) {
                        ?>
                        <h4> Posted by: <?php echo $item['user']['First_Name'] . " " . $item['user']['Last_Name']; ?>, 
                            Dined at:<?php echo date('h:i A', strtotime($item['Time'])); ?>
                        </h4>

                        <p> <?php echo $item['Text']; ?></p>
                        <hr>                       
                        <?php
                    }
                } else {
                    echo "<p> There are no reviews </p>";
                }

                if (!isset($_SESSION['user_login'])) {
                    ?>
                    <p> you can <a class="btn btn-danger" href="
                        <?php 
                            $_SESSION['backURL'] ="restaurant/details/";
                            $_SESSION['rest_id'] = $data['idRestaurants'];
                            echo PUBLIC_ROOT . "guest/login" 
                         ?>">log in</a> to post the review. </p>
                <?php } elseif (!$this->is_verified($data['idRestaurants'])) {
                    ?>

                    <p> You have to be a verified guest of a restaurant to post a review </p>
                    <?php
                }
                ?>

            </div>
               
            <div>
                <?php if ($this->is_verified($data['idRestaurants'])) { ?>
                    <form class="form" action="<?php echo PUBLIC_ROOT . "restaurant/post_review/" . $data['idRestaurants'] ?>" method="post" role="form">
                        <h3> Write a Review </h3>
                        <textarea class="form-control" type="text" placeholder="We would love to hear from you. " rows="4" name="review"></textarea> 
                        <button  type="submit" class="btn btn-danger btn-block form-control" value="post_Review" name="submit"> Add review </button>
                    </form>
                <?php } ?>
            </div>
            </div>
            
        </div>
        <?php
    } else {
        echo '<div class="row"><h3> </h3></div>';
    }
    ?>
</div>    
<br>
<br>






