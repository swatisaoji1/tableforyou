<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($data['msg'])) {
    ?>
    <div class="alert alert-warning">
        <?php echo $data['msg']; ?>
    </div>
    <?php
}
?>

<div class="center container">
    <h2>Welcome, Guest:</h2><br />
    <form class="loginForm form well" role="form" action="login" method="post" >
        <div class="form-group">
            <input class="form-control col-md-12" type="email" id="u_name" name="u_name" placeholder="Email" required/><br />
        </div>
        <div class="form-group">
            <input  class="form-control col-md-12" type="password" id="password" name="password" placeholder="Password" required/><br />
        </div>
        <div class="form-group">
            <input class="btn btn-default col-md-12" type="submit" value="Login" name="submit" /><br />
        </div>
        <a style="float:right" href="<?php echo PUBLIC_ROOT ?>guest/forgot">Forgot Your Password?</a><br />
    </form>
</div>
<br><br><br><br><br><br><br><br><br><br><br>