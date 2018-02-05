<?php

require_once 'dbconnection.php';

$u_name = $_POST['loginUserName'];
$u_password = $_POST['loginUserPassword'];
//$u_password = md5($u_password);


$query = "SELECT user_id, user_type, user_status FROM ducsbank.users where user_name='$u_name' AND password='$u_password'";
$result_userid = $conn->query($query);
$value = mysqli_fetch_object($result_userid);
if ($value !== NULL) {

    if ($value->user_status == "activated") {
        session_start();

        if ($value->user_type == "manager") {
            $_SESSION['manager_id'] = $value->user_id;
            header('Location: managerIndex.php');
            echo "manager";
            echo $_SESSION['manager_id'];
        } else if ($value->user_type == "customer") {
            header('Location: customerIndex.php');

            echo "customer";
            $_SESSION['customer_id'] = $value->user_id;
            echo $_SESSION['customer_id'];
        }
    } else {
        echo "Netbanking is not activated on your account. <br>";
        echo "Redirecting to home page NOW .. .. ..<br>";
        header("refresh:1;url=index.php");
        exit();
    }
//echo $_SESSION["u_id"];
} else {
    echo "invalid credentials<br>";
    echo "Redirecting to home page NOW .. .. ..<br>";
    header("refresh:1;url=index.php");
    exit();
}

$conn->close();
