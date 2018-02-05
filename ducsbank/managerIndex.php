<?php
session_start();
if (!($_SESSION["manager_id"])) {
    header("Location: index.php?error=notLoggedIn");
}
?>    
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>
        <?php
        //echo "I am a manager and my id is ";
        //echo $_SESSION["manager_id"];
        ?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">DUCS BANK</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="managerIndex.php">Home</a></li>
                    <li><a href="viewall.php">View All Customers</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>



        <div class="container">

            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <h1>
                        Manager Details
                    </h1>      

                    <?php
                    require_once './dbconnection.php';
                    $current_manager_id = $_SESSION['manager_id'];
                    $query = "SELECT * FROM ducsbank.managers where manager_user_id = '$current_manager_id';";
                    $result = $conn->query($query);
                    echo "<ul>";
                    $value = mysqli_fetch_object($result);

                    if ($value !== NULL) {
                        echo "<li><strong> ID </strong> : $value->manager_id </li> ";
                        echo "<li><strong> Name </strong> : $value->manager_name </li> ";
                        echo "<li><strong> Address </strong> : $value->manager_address </li> ";
                        echo "<li><strong> Email </strong> : $value->manager_email </li> ";
                        echo "<li><strong> Phone </strong> : $value->manager_phone </li> ";
                        $curr_branch_id = $value->manager_branch_id;
                    }

                    echo "</ul>";
                    ?>

                </div>
                <div class="col-lg-2"></div>

            </div>

            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <h1>
                        Branch Details
                    </h1>      

                    <?php
                    require_once './dbconnection.php';
                    $query1 = "SELECT * FROM ducsbank.branches where branch_id = '$curr_branch_id';";
                    $result1 = $conn->query($query1);
                    echo "<ul>";
                    $value = mysqli_fetch_object($result1);
                    if ($value !== NULL) {
                        echo "<li><strong> Bank Name </strong> DUCS BANK </li> ";

                        echo "<li><strong> Bank IFSC Code </strong> : $value->branch_IFSC_code </li> ";
                        echo "<li><strong> Bank Code </strong> : " . substr($value->branch_IFSC_code, -2) . " </li> ";
                        echo "<li><strong> Address </strong> : $value->branch_address </li> ";
                        echo "<li><strong> Email </strong> : $value->branch_email </li> ";
                        echo "<li><strong> Phone </strong> : $value->branch_phone </li> ";
                    }
                    echo "</ul>";
                    ?>

                </div>
                <div class="col-lg-2"></div>

            </div>
        </div>
    </body>
</html>
