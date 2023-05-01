<?php echo $loginheader;?>
<div id="loginbox">
    <?php if(!empty($msg)){?>
    <div class="alert alert-danger login-alert error_m">
        <span class="close">&nbsp;</span><?php echo "<font style='color:#ff000c;'>".$msg."</font>"; ?>
    </div>
    <?php } ?>
    <form id="loginform" class="form-vertical" method="post" action="<?php echo base_url();?>authenticate/login">
        <div class="control-group normal_text"> 
            <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
            <h3>
                <!--<img src="<?php echo base_url();?>assets/img/logo.png" alt="Logo" />-->
                
                <span style="color: #BA1E20">KPI </span>&nbsp;<span style="color: yellow">Report</span>
            </h3>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                    <input type="text" name="empcode" id="empcode" placeholder="Username" />
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                    <input type="password" id="login-password" name="password" placeholder="Password" />
                </div>
            </div>
        </div>
        <div class="form-actions">
            <!--<span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>-->
            <span class="pull-right"><input id="btnlogin" type="submit" class="btn btn-success" value="Login" /></span>
        </div>
    </form>
    <form id="recoverform" action="<?php echo base_url();?>authenticate/recover_password" class="form-vertical">
        <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>

        <div class="controls">
            <div class="main_input_box">
                <span class="add-on bg_lo"><i class="icon-envelope"></i></span>
                <input type="text" name="email" placeholder="E-mail address" />
            </div>
        </div>

        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
            <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
        </div>
    </form>
</div>
<?php echo $loginfooter;?>
