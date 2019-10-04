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
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>
        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/select2.min.js"></script>

        <link id="bsdp-css" href="css/bootstrap-datepicker.min.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.min.js"></script>

        <script>

            $(document).ready(function () {
                $('#sandbox-container .input-daterange').datepicker({
                    format: "yyyy-mm-dd",
                    maxViewMode: 2,
                    todayBtn: "linked",
                    clearBtn: true,
                    autoclose: true,
                    todayHighlight: true
                });
            });

        </script>

    </head>
    <body>
        <?php
//echo "I am a customer and my id is ";
//echo $_SESSION["customer_id"];
        ?>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">DUCS BANK</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="customerIndex.php">Home</a></li>
                    <li><a href="addBen.php">Add Beneficiary</a></li>
                    <li><a href="transferFunds.php">Transfer Funds</a></li>
                    <li class="active"><a href="viewStatement.php">View account Statement</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">

            <center>
                <h2>Account Statement </h2>
            </center>
            <br><br>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <form class="form-inline" method="POST" name="viewStatementForm" action="<?= ($_SERVER['PHP_SELF']) ?>">
                        <div class="col-lg-3" >
                            <label for="date-selection">Select your range </label>
                        </div>

                        <div class="col-lg-6" id="sandbox-container">

                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="input-sm form-control" name="start" />
                                <span class="input-group-addon">to</span>
                                <input type="text" class="input-sm form-control" name="end" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-default" name="view_statement_btn">View Statement</button>
                    </form> 
                </div>
                <div class="col-lg-2"></div>

            </div>
            <br><br>
            <div class="row">

                <div class="col-lg-2"></div>
                <div class="col-lg-8">

                    <div>

                        <?php
                        if (isset($_POST['view_statement_btn'], $_POST['start'], $_POST['end'])) {

                            $d1 = $_POST['start'];
                            $d2 = $_POST['end'];
                            ?>
                            <h4>
                                Showing Account Statement for period
                                <?php
                                echo "<b>" .
                                date("F jS, Y", strtotime($d1))
                                . "</b> to <b>" .
                                date("F jS, Y", strtotime($d2))
                                . "</b>";
                                ?>
                            </h4>

                            <?php
                            require_once './dbconnection.php';
                            $user = $_SESSION["customer_id"];

                            $query = 'SELECT * FROM ducsbank.transactions where trans_date between "' . $d1 . '" AND "' . $d2 . '"  AND trans_sender_id = (SELECT acc_id FROM ducsbank.accounts where acc_cust_id = (SELECT cust_id FROM ducsbank.customers where cust_user_id = ' . $user . '));';
                            //echo $query;
                            $result = $conn->query($query);

                            // display only when result >=1
                            $num_rows = mysqli_fetch_row($result);
                            if ($num_rows == 0) {
                                echo "<br><br><center><h2>No records found.</h2></center>";
                            } else {
                                ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Transferred to</th>
                                            <th>Amount</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {


                                            $query2 = 'SELECT cust_name FROM ducsbank.customers where cust_id =  (SELECT acc_cust_id FROM ducsbank.accounts where acc_id = ' . $row['trans_receiver_id'] . ' );';
                                            $result2 = $conn->query($query2);
                                            $row2 = mysqli_fetch_assoc($result2);

                                            echo "<tr>";
                                            echo "<td>" . $row2['cust_name'] . "</td>";
                                            echo "<td>" . $row['trans_amount'] . "</td>";
                                            echo "<td>" . date("F jS, Y", strtotime($row['trans_date'])) . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>


                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
                    </div>



                </div>
                </body>
                </html>
