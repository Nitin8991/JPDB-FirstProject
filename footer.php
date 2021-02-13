<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "http://login2explore.com/jpdb/resources/js/0.0.3/jpdb-commons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>

    <script type="text/javascript">
    

    $(".toggle").click(function(){
        document.getElementById("error").style.display = "none";
        $(".loginform").toggle();
        $(".signupform").toggle();
    });


    $("#submitsignup").click(function(){

        document.getElementById("error").style.display = "none";

        var email = $("#emailsignup").val();
        var password = $("#passwordsignup").val();
        var hidden = $("#hiddensignup").val();

        if(email === "" || password === "")
        {
            document.getElementById("error").style.display = "block";
        }
        else
        {
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
            var rObj = executeCommandAtGivenBaseUrl(jstr, "http://api.login2explore.com:5577", "/api/irl");
            jQuery.ajaxSetup({async : true});
            

            if(rObj.message === "DATA_HAS_BEEN_RETRIEVED_FROM_PI")
            {
                document.getElementById("error").innerHTML = "Email Address already exists";
                document.getElementById("error").style.display = "block";
                    
            }
            else
            {
                var jsonstring = {
                    playeremail : email,
                    playerpassword : password
                };

                var jsonStr = JSON.stringify(jsonstring);
                
                var putReq = createPUTRequest("90935430|-31948797722490438|90931893", jsonStr, "game", "game-player");

                jQuery.ajaxSetup({async:false});
                var resultObj = executeCommandAtGivenBaseUrl(putReq, "http://api.login2explore.com:5577", "/api/iml");
                jQuery.ajaxSetup({async : true});

                window.location.href = "nextpage.php?email="+email;
            }  
        }
    });

    $("#submitlogin").click(function(){
        
        document.getElementById("error").style.display = "none";
        var email = $("#emaillogin").val();
        var password = $("#passwordlogin").val();
        var hidden = $("#hiddenlogin").val();
        
        if(email === "" || password === "")
        {
            document.getElementById("error").style.display = "block";
        } 
        else
        {
            
            var jsonstring = {
                playeremail : email,
                playerpassword : password
            };

            var jsonStr = JSON.stringify(jsonstring);

            var getReq = createGETRequest("90935430|-31948797722490438|90931893", "game", "game-player", jsonStr);

            jQuery.ajaxSetup({async:false});
            var resultObj = executeCommandAtGivenBaseUrl(getReq, "http://api.login2explore.com:5577", "/api/irl");
            jQuery.ajaxSetup({async : true});

            if(resultObj.message === "DATA NOT FOUND")
            {
                document.getElementById("error").innerHTML = "Incorrect Email / Password";
                document.getElementById("error").style.display = "block";   
            }
            else
            {
                window.location.href = "nextpage.php?email="+email;
            }
        }
    });

    $("#cp").click(function(){

        var email = "<?php echo $_GET["email"] ?>";
        
        window.location.href = "changepassword.php?cp="+email;
    });

    var start = new Date().getTime();

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function makeshapeappear()
    {
        var top = Math.random() * 50;
        var width = (Math.random() * 30) + 5;
        var left = Math.random() * 50;

        document.getElementById("shape").style.backgroundColor = getRandomColor();
        document.getElementById("shape").style.top = top + "%";
        document.getElementById("shape").style.left = left + "%";
        document.getElementById("shape").style.width = width + "%";
        document.getElementById("shape").style.height = width + "%";

        if(Math.random() > 0.5)
        {
            document.getElementById("shape").style.borderRadius = "50%";
        }
        else
        {
            document.getElementById("shape").style.borderRadius = "0";
        }
        document.getElementById("shape").style.display = "block";

        start = new Date().getTime();
    }

    function appearafterdelay()
    {
        setTimeout(makeshapeappear, Math.random() * 1000);
    }

    appearafterdelay();

    document.getElementById("shape").onclick = function(){

    
        document.getElementById("shape").style.display = "none";

        var end = new Date().getTime();

        var totaltime = (end-start)/1000;

        document.getElementById("timetaken").innerHTML = totaltime + " sec";

        appearafterdelay();
    }
    </script>
</html>