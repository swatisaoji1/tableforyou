<div class="alert alert-warning alert-dismissible alert-div" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    SFSU software Engineering Project, Fall 2014 - Team 14  (For Demonstration Only)
</div>

<nav class="navbar navbar-default t4u_navbar">

    <div class="container-fluid">
        <div class="navbar-header col-md-2">   

            <a href="<?php echo PUBLIC_ROOT ?>" class="span1">
                <img alt="Brand" src="<?php echo PUBLIC_ROOT . 'img/tblforyou_logo.gif' ?>" />
            </a>
        </div>
        <div class="col-md-10">
            <div class="row" style="padding-bottom: 0;margin-bottom: 0">

                <div class="navbar-text text-right pull-right">
                    <?php
                    if (isset($_SESSION['name']) && isset($_SESSION['user_login'])) {
                        echo "<p class=\"nav-text common-header-ul\"> Welcome " . $_SESSION['name'] . " </p>";
                    } else {
                        echo "<p class=\"nav-text common-header-ul\">&nbsp;</p>";
                    }
                    ?>
                </div>

            </div>                    


            <div class="row nav">

                <div class="container col-md-12" style="padding-right: 0;margin-right: 0"> 
                    <ul class="pull-right nav-text common-header-ul" id="navigationUl">                    
                        <li><a href="<?php echo PUBLIC_ROOT ?>restaurant/add">Register your restaurant</a></li>      
                        <li><a href="<?php echo PUBLIC_ROOT . 'about/about'; ?>">About</a></li>      
                        <?php
// Modified by Yeqing Yan. Dec 11
// Remove user type check and user_login check.
//if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == 1 && $_SESSION['User_type'] == "2") {
                        if (isset($_SESSION['name']) && isset($_SESSION['user_login'])) {
                            //echo "<li class=\"nav-text\"> Welcome " . $_SESSION['name'] . " </li>";
                            echo "<li><a href=" . PUBLIC_ROOT . "guest/logout >Log out</a></li>";
                        } else {
                            echo "<li><a href=" . PUBLIC_ROOT . "guest/login >Log in</a></li>";
                            echo "<li><a href=" . PUBLIC_ROOT . "guest/add >Sign Up</a></li>";
                        }
                        ?>

                    </ul>   
                </div>                       
            </div>
        </div>
    </div>
</nav>
