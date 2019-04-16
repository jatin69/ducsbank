<?php

error_reporting(0);

session_start();

if (isset($_POST['fund_transfer_acc_no'], $_POST['fund_transfer_amount'], $_POST['fund_transfer_btn'])) {

    require_once './dbconnection.php';

    $curr_user_id = $_SESSION["customer_id"];
    $query = "(SELECT acc_no FROM ducsbank.accounts where acc_cust_id = "
            . "(SELECT cust_id FROM ducsbank.customers where cust_user_id = $curr_user_id));";

    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);

    $sender = $row['acc_no'];
    $receiver = $_POST['fund_transfer_acc_no'];
    $amount = $_POST['fund_transfer_amount'];

    $q1 = "SELECT balance FROM ducsbank.accounts where acc_no = " . $sender . ";";
    $re1 = $conn->query($q1);
    $ro1 = mysqli_fetch_assoc($re1);
    $available_amount = $ro1["balance"];

    $q2 = "SELECT ben_transfer_limit FROM ducsbank.beneficiaries where ben_bank_ac_no = " . $receiver . ";";
    $re2 = $conn->query($q2);
    $ro2 = mysqli_fetch_assoc($re2);
    $transfer_limit = $ro2["ben_transfer_limit"];

    //echo $transfer_limit;

    if ($amount > $transfer_limit) {
        ?>
        <script language="javascript">
            alert("Failure : Amount listed in more than permitted limit. Please remain within limit.");
            window.location.href = 'transferFunds.php';
        </script>
        <?php

        exit(1);
    } else if ($amount > $available_amount) {
        ?>
        <script language="javascript">
            alert("Failure : Insufficient Amount in account !");
            window.location.href = 'transferFunds.php';
        </script>

        <?php

        exit(1);
    }
    // check if amount < bank money
    // if not, break here 
    // begin transaction
    // 1. debit from sender
    // 2. credit to receiver
    // 3. make entry in transactions
    // wokring

    try {
        // First of all, let's begin a transaction
        //$conn->beginTransaction();
        $conn->begin_transaction(MYSQLI_TRANS_START_READ_ONLY);
        // A set of queries; if one fails, an exception should be thrown

        $query1 = "UPDATE ducsbank.accounts SET balance= balance - $amount WHERE acc_no = $sender;";
        if ($conn->query($query1) === TRUE) {
            //  echo "Record updated successfully";
        }
        // needs a better mechanism for checking for failure, this one doesn't work.
        $query2 = "UPDATE ducsbank.accounts SET balance= balance + $amount WHERE acc_no = $receiver;";
        if ($conn->query($query2) === TRUE) {
            // echo "Record updated successfully";
        }

        $query3 = "INSERT INTO `ducsbank`.`transactions` (`trans_sender_id`, `trans_receiver_id`, `trans_amount`) VALUES (?,?,?);";
        $stmt2 = $conn->prepare($query3);
        $stmt2->bind_param("iii", $sender, $receiver, $amount);
        if ($stmt2->execute() == true) {
            //echo 'all good';
        }

        // If we arrive here, it means that no exception was thrown
        // i.e. no query has failed, and we can commit the transaction
        $conn->commit();
        ?>
        <script language="javascript">
            alert("transaction successful.");
            window.location.href = 'transferFunds.php';
        </script>
        <?php

    } catch (Exception $e) {
        // An exception has been thrown
        // We must rollback the transaction
        $conn->rollback();
    }
} else {
    ?>
    <script language="javascript">
        alert("Invalid Access !");
        window.location.href = 'transferFunds.php';
    </script>
    <?php

}
