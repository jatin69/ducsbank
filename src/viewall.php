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
                    <li class=""><a href="managerIndex.php">Home</a></li>
                    <li class="active"><a href="viewall.php">View All Customers</a></li>
                    <li><a href="logout.php">Logout</a></li>

                </ul>
            </div>
        </nav>



        <div class="container">

            <div class="row">

                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <h1>
                        Accounts Section
                    </h1>      


                    <br>
                    <div class="row">
                        <form class="form-inline" method="POST" action="<?= ($_SERVER['PHP_SELF']) ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Account number" name="acc_filter"
                                       value=" <?php
        if (!(isset($_POST["acc_filter"]))) {
            echo "";
        } else {
            echo $_POST["acc_filter"];
        }
        ?>"  >
                            </div>
                            <button type="submit" name="filter_btn" class="btn btn-default">Search </button>
                        </form>


                    </div>
                    <br>

                    <?php
                    if (!(isset($_POST["filter_btn"]))) {
                        ?>
                        <div>
                            <h2>
                                All accounts
                            </h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Account Number</th>
                                        <th>Account Type</th>
                                        <th>Balance</th>
                                        <th>Account Start date</th>
                                        <th>Account Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    require_once './dbconnection.php';
                                    $current_manager_id = $_SESSION['manager_id'];
                                    $query = "SELECT * FROM ducsbank.managers where manager_user_id = '$current_manager_id';";
                                    $result = $conn->query($query);
                                    echo "<ul>";
                                    $value = mysqli_fetch_object($result);
                                    if ($value !== NULL) {
                                        
                                    }
                                    $curr_branch_id = $value->manager_branch_id;
                                    $query1 = "SELECT acc_no, acc_type, balance, acc_start_date, acc_status FROM ducsbank.accounts where acc_branch_id = '$curr_branch_id' ;";


                                    $result1 = $conn->query($query1);
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['acc_no'] . "</td>";
                                        echo "<td>" . $row['acc_type'] . "</td>";
                                        echo "<td>" . $row['balance'] . "</td>";
                                        echo "<td>" . date("F jS, Y", strtotime($row['acc_start_date'])) . "</td>";
                                        echo "<td>" . $row['acc_status'] . "</td>";


                                        echo "</tr>";
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>

                        <?php
                    } else {
                        ?>
                        <div>
                            <h2>
                                Search Result
                            </h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Account Number</th>
                                        <th>Account Type</th>
                                        <th>Balance</th>
                                        <th>Account Start date</th>
                                        <th>Account Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    require_once './dbconnection.php';
                                    $current_manager_id = $_SESSION['manager_id'];
                                    $query = "SELECT * FROM ducsbank.managers where manager_user_id = '$current_manager_id';";
                                    $result = $conn->query($query);
                                    echo "<ul>";
                                    $value = mysqli_fetch_object($result);
                                    if ($value !== NULL) {
                                        
                                    }
                                    $curr_branch_id = $value->manager_branch_id;
                                    $query1 = "SELECT acc_no, acc_type, balance, acc_start_date, acc_status "
                                            . "FROM ducsbank.accounts where acc_branch_id = '$curr_branch_id' AND acc_no = "
                                            . htmlspecialchars($_POST["acc_filter"]) . ";";


                                    $result1 = $conn->query($query1);
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['acc_no'] . "</td>";
                                        echo "<td>" . $row['acc_type'] . "</td>";
                                        echo "<td>" . $row['balance'] . "</td>";
                                        echo "<td>" . date("F jS, Y", strtotime($row['acc_start_date'])) . "</td>";
                                        echo "<td>" . $row['acc_status'] . "</td>";


                                        echo "</tr>";
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>



                        <?php
                    }
                    ?>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </body>
</html>
