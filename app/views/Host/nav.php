<div class="alert alert-warning alert-div" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    SFSU software Engineering Project, Fall 2014 - Team 14  (For Demonstration Only)
</div>
<nav class="navbar navbar-default t4u_navbar">
    <div class="container-fluid">
        <div class="navbar-header">                
            <a href="<?php echo PUBLIC_ROOT ?>">
                <img alt="Brand" src="<?php echo PUBLIC_ROOT . 'img/tblforyou_logo.gif' ?>" />
            </a>
        </div>     
        <div class="nav">
            <div class="container"> 
                <ul class="pull-right nav-text common-header-ul" id="navigationUl">       
                    <?php
                    if (!defined('SID')) {
                        session_start();
                    }
                    if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == "1" && $_SESSION['User_type'] == "3") {
                        echo "<li class=\"nav-text\"> Welcome " . $_SESSION['name'] . " </li>";
                        echo "<li><a href=" . PUBLIC_ROOT . "host/logout >Log out</a></li>";
                    }
                    ?>
                </ul>   
            </div>                       
        </div>
    </div>
</nav>


