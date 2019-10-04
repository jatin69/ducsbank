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
        <script src="js/jquery.min.js"></script>
        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
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
                    <li class="active"><a href="transferFunds.php">Transfer Funds</a></li>
                    <li><a href="viewStatement.php">View account Statement</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">

            <center>
                <h2>Transfer funds </h2>
            </center>
            <div class="row">

                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <h3>
                        Choose a Beneficiary
                    </h3>

                    <form name="fund_transfer_form" method="POST" action="transferFundsHandler.php">
                        <div class="form-group">
                            <select class="js-example-basic-multiple" name="fund_transfer_acc_no" style="width: 555px" >
                                <option value=""> -- Choose a beneficiary -- </option>
                                <?php
                                require_once './dbconnection.php';

                                $curr_user_id = $_SESSION["customer_id"];
                                $query = "SELECT * FROM ducsbank.beneficiaries where ben_acc_id = "
                                        . "(SELECT acc_id FROM ducsbank.accounts where acc_cust_id = "
                                        . "(SELECT cust_id FROM ducsbank.customers where cust_user_id = $curr_user_id));";

                                $result = $conn->query($query);
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo "<option value='" . $row["ben_bank_ac_no"] . "'>";
                                    echo $row["ben_name"] . " - " . $row["ben_bank_ac_no"] . "</option>";
                                }
                                ?>


                            </select>



                        </div>
                        <br>

                        <div class="form-group">
                            <label for="name">Amount to be transferred</label>
                            <input type="number" class="form-control" name="fund_transfer_amount" required>
                        </div>
                        <button type="submit" class="btn btn-default" name="fund_transfer_btn">Make Payment</button>

                    </form>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>




    </body>
</html>
