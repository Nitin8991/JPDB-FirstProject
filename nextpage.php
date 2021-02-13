<?php
    if(array_key_exists("email", $_GET))
    {

    }
    else
    header("Location:newproject.php");
?>

<?php
    include("header.php");
?>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">Check your reaction</a>
    <a><button class="btn btn-outline-warning my-2 my-sm-0" id="cp" type="submit">Change Password</button></a>
    <a href='newproject.php?logout=1'><button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button></a>
</nav>
<div class = "game">
    <div class="indication">
        <p><strong>Click the shapes quickly as you can</strong></p>
        <p><strong>Your Time :</strong> <span id="timetaken"></span></p>
    </div>
    <div id="shape"></div>
</div>

<?php
    include("footer.php");
?>