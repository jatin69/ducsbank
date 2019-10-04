<?php
session_start();
if (!($_SESSION["customer_id"])) {
    header("Location: index.php?error=notLoggedIn");
}
?> 

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>
        <!--<link rel="stylesheet" href="css/custom.css">-->

    </head>
    <body>
        <?php
//        echo "I am a customer and my id is ";
//        echo $_SESSION["customer_id"];
        ?>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">DUCS BANK</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="customerIndex.php">Home</a></li>
                    <li><a href="addBen.php">Add Beneficiary</a></li>
                    <li><a href="transferFunds.php">Transfer Funds</a></li>
                    <li><a href="viewStatement.php">View account Statement</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <h1>
                        Account Details
                    </h1>      

                    <?php
                    require_once './dbconnection.php';
                    $current_cust_id = $_SESSION['customer_id'];
                    $query = "SELECT * FROM ducsbank.customers where cust_user_id = '$current_cust_id';";
                    //$query = "select * from customers WHERE cust_user_id='$current_cust_id'";
                    $result = $conn->query($query);
                    echo "<ul>";
                    $value = mysqli_fetch_object($result);
                    if ($value !== NULL) {
                        echo "<li><strong> CIF Number </strong> : $value->CIF_number </li> ";
                    }

                    $query2 = "SELECT * FROM ducsbank.accounts where acc_cust_id = ( SELECT cust_id FROM ducsbank.customers where cust_user_id = '$current_cust_id' );";
                    $result2 = mysqli_query($conn, $query2);

                    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                        if ($row !== NULL) {
                            echo "<li><strong> Account Number </strong> :" . $row['acc_no'] . " </li> ";
                            echo "<li><strong> Account Type </strong> :" . $row['acc_type'] . " </li> ";

                            $query3 = "SELECT branch_IFSC_code FROM ducsbank.branches where branch_id = " . $row['acc_branch_id'] . ";";
                            $result3 = mysqli_query($conn, $query3);
                            $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                            echo "<li><strong> Branch IFSC code </strong> :" . $row3['branch_IFSC_code'] . " </li> ";

                            echo "<li><strong> Balance </strong> :" . $row['balance'] . " </li> ";
                            echo "<li><strong> Account Start Date </strong> :" . date("F jS, Y", strtotime($row['acc_start_date'])) . " </li> ";
                        }
                    }

                    echo "</ul>";
                    ?>





                </div>
                <div class="col-lg-2"></div>

            </div>

        </div>

    </body>
</html>
