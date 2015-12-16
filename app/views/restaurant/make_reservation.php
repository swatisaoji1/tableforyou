
<div class="regContainer container"> 
    <form action="<?php echo PUBLIC_ROOT . "restaurant/search" ?>" method="post">
        <input class="btn btn-danger" type="submit" value=" < ">
        <input class="btn-link" type="submit" value="Back to Search">
    </form>
    
    <h2>Complete your reservation</h2><br>
    <div class="container row">
        <div class="col-md-4">


            <h5 style="color:#333300 "><?php echo $data['restaurant']['Name'] ?></h5>
            <img src="<?php echo PUBLIC_ROOT . 'image/' . $data['restaurant']['Restaurant_Images_idRestaurant_Images'] ?>" hight="200" width="200"></img>
            <h5>Already a member?
                <a id="signinlink" 
                   href="<?php
                   // store rest id in session to complete reservation after logging in
                   $_SESSION['backURL'] = "restaurant/reservation_complete/";
                   $_SESSION['rest_id'] = $data['restaurant']['idRestaurants'];
                   echo PUBLIC_ROOT . 'guest/login';
                   ?>">
                    Sign in
                </a>
            </h5> 
        </div>
        <div class="col-md-8">
            <h3>You are reserving the table for:</h3>
            <h4>Guests : <?php echo $_SESSION['choice']['people']; ?></h4>
            <h4>Date   : <?php echo $_SESSION['choice']['date']; ?></h4>
            <h4>Time   : <?php echo $_SESSION['choice']['time']; ?></h4>
        </div>
    </div>
    <form class="form well" role="form" action="<?php echo PUBLIC_ROOT . "restaurant/reservation_complete/" . $data['restaurant']['idRestaurants']; ?>" method="post" enctype="multipart/form-data" >

        <p><span class="required_marker">*</span> indicates required field</p><br/>
        <div class="form-group">
            <div class="row">
                <label class="col-md-3">Full Name: <span class="required_marker">*</span></label>
                <div class="col-md-4">
                    <input class="form-control" type="text" id='f_name' name="f_name" placeholder="First Name" required>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" id='l_name' name="l_name" placeholder="Last Name" maxlenght="20" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label class="col-md-3">Contact Email: <span class="required_marker">*</span></label>
                <div class="col-md-8">
                    <input class="form-control" type="email" id="e_mail" name="e_mail" placeholder="Email" required>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="row">
                <label class="col-md-3">Phone No: <span class="required_marker">*</span></label>
                <div class="col-md-8">
                    <input class="form-control" type="tel" pattern=".{10,}" id="tel_no" name="tel_no" placeholder="8888888888" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label class="col-md-3"></label>
                <div class="col-md-8">
                    <input type="checkbox" id="agree" value="0" onclick="activate()" /> I agree to the Table for You <a href="#" onclick="window.open('<?php echo PUBLIC_ROOT . 'about/terms'; ?>', '_blank')">Terms of Service</a> and <a href="#" onclick="window.open('<?php echo PUBLIC_ROOT . 'about/privacy'; ?>', '_blank')">Privacy Policy</a>.
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-md-9"></label>
            <div class="col-md-2">
                <input class="btn btn-default" type="submit" value="Complete Reservation" name="submit" id="submit" disabled/>
            </div>
        </div>
    </form>
</div>

