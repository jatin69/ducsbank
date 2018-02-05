<?php
error_reporting(0);
session_start();
if (isset($_SESSION["customer_id"])) {
    header("Location: customerIndex.php");
} else if (isset($_SESSION["manager_id"])) {
    header("Location: managerIndex.php");
}
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>


        <!-- Template CSS Files
        ================================================== -->
        <!-- Twitter Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!--<script src="js/validator.js"></script>-->

        <!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>


        <link  href="css/custom.css" rel="stylesheet" type="text/css" >
    </head>
    <body>

        <?php
//        include("./header.php");
        ?>
        <form action="loginHandler.php" method="post"  name="loginform">
            <div id="signuphome">
                <h2 >
                    Login To Bank
                </h2>
                <div class="field">
                    <div>
                        <?php
                        if (isset($_REQUEST["error"]) && $_REQUEST['error'] == 'notLoggedIn') {
                            echo " <h3 style='color: red'> Please login to contiue </h3> ";
                        }
                        ?>
                    </div>
                </div>

                <div class="field" >
                    <div>user name</div>
                    <div><input type="text" name="loginUserName" ></div>
                </div>
                <div class="field">
                    <div>password</div>
                    <div><input type="password" name="loginUserPassword"></div>
                </div>
                <br>
                <div class="field">
                    <input  type="submit" value="LOGIN" name="login"></input>
                </div>
            </div>
        </form>

        <?php
//        include("./footer.php");
        ?>


    </body>
</html>
