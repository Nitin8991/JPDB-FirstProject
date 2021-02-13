<?php include("header.php") ?>
    
    <div class = "container">
        <h1 class="innertext">Play Reaction Tester Game</h1>

        <p class="innertext">Check Your reaction time.</p>
        <div id="error" class = "alert alert-danger">Fill form completely.</div>

        <div class="signupform">
            <p class="innertext">Interested? Sign up now</p>
            <div class="form-group">
                <input name = "email" id="emailsignup" class = "form-control" type = "email" placeholder = "Email address">
            </div>
            <div class ="form-group">
                <input name = "password" id="passwordsignup" class="form-control" type = "password"  placeholder = "password">
            </div>
            
            <input type="hidden" id="hiddensignup" class="form-control" name="signup" value="1">
            <div class ="form-group">
                <input type = "submit" id="submitsignup" class="btn btn-primary" name="submit" value = "sign up ">
            </div>

            <p><a class="toggle">Log In</a></p>
        </div>

        <div class="loginform">
            <p class="innertext">Log in with your email and password</p>
            <fieldset class ="form-group">
                <input name = "email" id="emaillogin" class="form-control" type = "email" placeholder = "Email address">
            </fieldset>
            <fieldset class ="form-group">
                <input name = "password" id="passwordlogin" class="form-control" type = "password" placeholder = "password">
            </fieldset>
            
            <input type="hidden" id="hiddenlogin" class="hidden" name="signup" value="0">
            <fieldset class="form-group">
                <input type = "submit" id="submitlogin" class="btn btn-primary" name="submit" value = "Log in">
            </fieldset>

            <p><a class="toggle">Sign Up</a></p>
        </div>

    </div>

 <?php include("footer.php") ?>
