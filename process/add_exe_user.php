<?php
session_start();
include_once('../config/database.php');
$table_name     = "users";
$user_level     = "userLevel";
$user_name      = "userName";
$last_name      = "lastName";
$first_name     = "firstName";
$middle_name    = "middleName";
$contact_number = "contactNumber";
$password       = "pword";
$date_created   = "dateCreated";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userLevel = $_POST['userLevel'];
    $userName = $_POST['userName'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $contactNumber = $_POST['contactNumber'];
    
    $err = [
        'err_userLevel' => '',
        'err_userName' => '',
        'err_lastName' => '',
        'err_firstName' => '',    
        'err_contactNumber' => '',
    ];
    
    if (empty($userLevel)) {
        $err['err_userLevel'] = "Select a user level from the drop down menu.";
    }
    if (empty($userName)) {
        $err['err_userName'] = "cannot be blank.";
    }
    if (empty($lastName)) {
        $err['err_lastName'] = "cannot be blank.";
    }
    if (empty($firstName)) {
        $err['err_firstName'] = "cannot be blank.";
    }
    
    if (empty($contactNumber)) {
        $err['err_contactNumber'] = "cannot be blank.";
    }

    if (empty(array_filter($err))) {
        $dateCreated = date('Y-m-d');
        $pword = md5 ('abc2321');

        $query = "INSERT INTO $table_name (
            $user_level,
            $user_name,
            $last_name,
            $first_name,
            $middle_name,
            $contact_number,
            $password,
            $date_created
        )
        VALUES (
            '$userLevel',
            '$userName', 
            '$lastName',
            '$firstName',
            '$middleName',
            '$contactNumber',
            '$pword',
            '$dateCreated')";

        if (mysqli_query($conn, $query)) {
            echo '<br>User was Added Successfully!';
        } else {
            echo '<br>Error: ' . $query . ' ' . mysqli_error($conn);
        }
        mysqli_close($conn);
    } else {
        $_SESSION['err'] = $err;
        header('location: ../user/add_user.php');
    }
}
?>