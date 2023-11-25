<?php
session_start();
include_once('../config/database.php');
// PALITAN MO NAME NG TABLE NAME MO KUNG ANO TABLE NAME MO.
// INCLUDE IN HERE "" THE VARIABLES(COLUMNS) YOU USE IN YOUR DATABASE, MAKE SURE THE SPELLING IS THE SAME.
$table_name     = "students";
$user_level     = "userLevel";
$full_name      = "fullName";
$student_number = "studentNumber";
$midterm_grade  = "midtermGrade";
$final_grade    = "finalGrade";
$date_created   = "dateCreated";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userLevel = $_POST['userLevel'];
    $fullName = $_POST['fullName'];
    $studentNumber = $_POST['studentNumber'];
    $midtermGrade = $_POST['midtermGrade'];
    $finalGrade = $_POST['finalGrade'];

    $err = [
        'err_userLevel' => '',
        'err_fullName' => '',
        'err_studentNumber' => '',
        'err_midtermGrade' => '',
        'err_finalGrade' => '',       
    ];
    
    if (empty($userLevel)) {
        $err['err_userLevel'] = "Select a user level from the drop down menu.";
    }
    if (empty($fullName)) {
        $err['err_fullName'] = "Your Full Name cannot be blank.";
    }
    if (empty($studentNumber)) {
        $err['err_studentNumber'] = "Student Number cannot be blank.";
    }
    if (empty($midtermGrade)) {
        $err['err_midtermGrade'] = "Midterm Grade cannot be blank.";
    }
    if (empty($finalGrade)) {
        $err['err_finalGrade'] = "Final Grade cannot be blank.";
    }

    if (empty(array_filter($err))) {
        $dateCreated = date('Y-m-d');

        $query = "INSERT INTO $table_name (
            $user_level,
            $full_name,
            $student_number,
            $midterm_grade,
            $final_grade,
            $date_created
        )
        VALUES (
            '$userLevel',
            '$fullName', 
            '$studentNumber',
            '$midtermGrade',
            '$finalGrade',
            '$dateCreated')";

        if (mysqli_query($conn, $query)) {
            echo '<br>User was Added Successfully!';
        } else {
            echo '<br>Error: ' . $query . ' ' . mysqli_error($conn);
        }
        mysqli_close($conn);
    } else {
        $_SESSION['err'] = $err;
        header('location: ../user/add.php');
    }
}
?>