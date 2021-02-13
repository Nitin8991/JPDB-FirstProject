<?php

    if(array_key_exists("cp", $_GET))
    {

    }
    else
    header("Location:newproject.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Change Password</title>

    <style type="text/css">

    .container{
        text-align: center;
        border: 3px solid green;
        position: absolute;
        top: 35%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
    }

    .inputbits{
        display: block;
        margin-right: auto;
        margin-left: auto;
        width:30%;
    }

    .btn{
        margin-bottom:1%;
        margin-top:2%;
    }

    #error{
        display : none;
    }
    </style>
  </head>
  <body>
  <div class="container">
    <h1>Change Password</h1>

    <div class="alert alert-danger" id="error" role="alert">
    </div>
    Old password : <input type="text" id="oldpassword" class="inputbits" class="form-control" aria-describedby="passwordHelpBlock">
    New password : <input type="text" id="newpassword" class = "inputbits" class="form-control" aria-describedby="passwordHelpBlock">
    Retype new password : <input type="text" id="retypepassword" class = "inputbits" class="form-control" aria-describedby="passwordHelpBlock">
    
    <button type="button" id="changepassword" class="btn btn-primary">Change Password</button>
    
</div>

    
    
  </body>

  
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "http://login2explore.com/jpdb/resources/js/0.0.3/jpdb-commons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">

        $("#changepassword").click(function(){
            document.getElementById("error").style.display = "none";
            var oldpass = $("#oldpassword").val();
            var newpass = $("#newpassword").val();
            var retypepass = $("#retypepassword").val();

            if(oldpass === "" || newpass === "" || retypepass === "")
            {
                document.getElementById("error").innerHTML = "Enter all details";
                document.getElementById("error").style.display = "block";
            }
            else if(newpass !== retypepass)
            {
                document.getElementById("error").innerHTML = "New passwords don't match";
                document.getElementById("error").style.display = "block";
            }
            else
            {
                var email = "<?php echo $_GET['cp']; ?>";

                var jsonstring = {
                    playeremail : email,
                    playerpassword : oldpass
                };

                
                var jsonStr = JSON.stringify(jsonstring);
                
                var getReq = createGETRequest("90935430|-31948797722490438|90931893", "game", "game-player", jsonStr);

                jQuery.ajaxSetup({async:false});
                var resultObj = executeCommandAtGivenBaseUrl(getReq, "http://api.login2explore.com:5577", "/api/irl");
                jQuery.ajaxSetup({async : true});

                if(resultObj.message === "DATA NOT FOUND")
                {
                    document.getElementById("error").innerHTML = "Incorrect Old Password";
                    document.getElementById("error").style.display = "block";   
                }
                else
                {
                    var email = "<?php echo $_GET['cp']; ?>";
                    var jstr = JSON.stringify({
                            "token": "90935430|-31948797722490438|90931893",
                            "dbName": "game",
                            "cmd": "GET_BY_KEY",
                            "rel": "game-player",
                            "createTime": true,
                            "updateTime": true,
                            "jsonStr": {
                                "playeremail": email
                            }
                        });

                    jQuery.ajaxSetup({async:false});
                    var resultObj = executeCommandAtGivenBaseUrl(jstr, "http://api.login2explore.com:5577", "/api/irl");
                    jQuery.ajaxSetup({async : true});

                    var obj = JSON.parse(resultObj.data);
                    var record = obj.rec_no;

                    var update = {
                        "token": "90935430|-31948797722490438|90931893",
                        "cmd": "UPDATE",
                        "dbName": "game",
                        "rel": "game-player",
                        "jsonStr": {
                    }
                    };

                    update.jsonStr[record] = {
                        playeremail : email,
                        playerpassword : newpass
                    };

                    var final = JSON.stringify(update);

                    jQuery.ajaxSetup({async:false});
                    var rltObj = executeCommandAtGivenBaseUrl(final, "http://api.login2explore.com:5577", "/api/iml");
                    jQuery.ajaxSetup({async : true});

                    alert("Password Changed Successfully");

                    window.location.href = "nextpage.php?email="+email;
                }
            }
        });
    
    </script>
</html>