# This project is all about basics of JsonPowerDB (JPDB) and how to use JPDB for CRUD operations.

# Website Link
goblin.epizy.com/jpdb/newproject.php

# About JsonPowerDB:
JsonPowerDB is a Real-time, High Performance, Lightweight and Simple to Use, Rest API based Multi-mode DBMS. JsonPowerDB has ready to use API for Json document DB, RDBMS, Key-value DB, GeoSpatial DB and Time Series DB functionality. JPDB supports and advocates for true serverless and pluggable API development.

# Benefits of using JsonPowerDB
Simplest way to retrieve data in a JSON format.
Schema-free, Simple to use, Nimble and In-Memory database.
It is built on top of one of the fastest and real-time data indexing engine - PowerIndeX.
It is low level (raw) form of data and is also human readable.
It helps developers in faster coding, in-turn reduces development cost.

# Screenshot
![Screenshot (74)](https://user-images.githubusercontent.com/59838695/107844020-f8971c80-6df5-11eb-8afa-7f9ed28e2f17.png)

# JPDB Code In Project

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
