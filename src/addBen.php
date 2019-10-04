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
                    <li class="active"><a href="addBen.php">Add Beneficiary</a></li>
                    <li><a href="transferFunds.php">Transfer Funds</a></li>
                    <li><a href="viewStatement.php">View account Statement</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <center>
                        <h1>
                            Add beneficiary
                        </h1>
                    </center>
                    <form name="add_ben_form" method="POST" action="addBenHandler.php">
                        <div class="form-group">
                            <label for="name">Beneficiary Name</label>
                            <input type="text" class="form-control" name="ben_name" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Beneficiary Account number</label>
                            <input type="text" class="form-control" name="ben_acc_no" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Beneficiary Bank Name</label>
                            <input type="text" class="form-control" value="DUCS BANK" name="ben_bank_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Beneficiary Bank IFSC Code</label>
                            <input type="text" class="form-control" name="ben_bank_ifsc" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Transfer limit</label>
                            <input type="text" class="form-control" name="ben_transfer_limit" required>
                        </div>
                        <button type="submit" class="btn btn-default" name="ben_add_btn">Submit</button>
                    </form>

                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </body>
</html>
