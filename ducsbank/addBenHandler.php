<?php

session_start();

if (isset($_POST["ben_add_btn"], $_POST["ben_name"], $_POST["ben_acc_no"], $_POST["ben_bank_name"], $_POST["ben_bank_ifsc"], $_POST["ben_transfer_limit"]
        )) {

    $acc = $_POST["ben_acc_no"];
    if (!(!filter_var($acc, FILTER_VALIDATE_INT) === 0 || !filter_var($acc, FILTER_VALIDATE_INT) === false)) {
        ?>
        <script language="javascript">
            alert("Account number should be numeric only");
            window.location.href = 'addBen.php';
        </script>
        <?php

        exit();
    }

    $limit = $_POST["ben_transfer_limit"];
    if (!(!filter_var($limit, FILTER_VALIDATE_INT) === 0 || !filter_var($limit, FILTER_VALIDATE_INT) === false)) {
        ?>
        <script language="javascript">
            alert("Limit should be numeric");
            window.location.href = 'addBen.php';
        </script>
        <?php

        exit();
    }

    $name = filter_var($_POST["ben_name"], FILTER_SANITIZE_STRING);

//$bank = $_POST["ben_bank_name"];
    $ifsc = $_POST["ben_bank_ifsc"];

    $ben_acc_id = $_SESSION['customer_id'];

    require_once './dbconnection.php';
    $query = "INSERT INTO `ducsbank`.`beneficiaries` (`ben_acc_id`, `ben_name`, `ben_bank_ifsc_code`, `ben_transfer_limit`, `ben_bank_ac_no`) VALUES (?,?,?,?,?);";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $ben_acc_id, $name, $ifsc, $limit, $acc);
    if ($stmt->execute() == true) {
        ?>
        <script language="javascript">
            alert("Beneficiary successfully added. You can now transfer funds");
            window.location.href = 'transferFunds.php';
        </script>
        <?php

    }
} else {
    ?>
    <script language="javascript">
        alert("Incomplete Details. Please fill all the details");
        window.location.href = 'addBen.php';
    </script>
    <?php

    exit();
}