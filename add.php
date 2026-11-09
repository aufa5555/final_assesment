<?php

include 'header.php';
include 'db.php';

$student_name = "";
$matric_number = "";
$subject_name = "";
$subject_code = "";
$test1 = "";
$test2 = "";
$final_examination = "";


if (isset($_POST['Submit'])) {
    $student_name = $_POST['student_name'];
    $matric_number = $_POST['matric_number'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final_examination = $_POST['final_examination'];

    $total = $test1 + $test2 + $final_examination;
    //80-100 = A
    //65-79 = B
    //50-64 = C
    //40-49 = D
    //0-39 = E  
    if ($total >= 80)
        $final_grade = 'A';
    elseif ($total >= 65)
        $final_grade = 'B';
    elseif ($total >= 50)
        $final_grade = 'C';
    elseif ($total >= 40)
        $final_grade = 'D';
    else
        $final_grade = 'E';

    $sql = $conn->prepare("INSERT INTO result (`student_name`, `matric_number`, `subject_name`, `subject_code`, `test1`, `test2`, `final_examination`,final_grade, `total_marks`)
  VALUES ('$student_name', '$matric_number', '$subject_name', '$subject_code', $test1, $test2, $final_examination, '$final_grade', $total)");

    if ($sql->execute())
        header("Location: index.php");
    exit;
}

?>
<style>
    label {
        display: inline-block;
        width: 200px;
    }
</style>
<hr>

<h2>Add Result</h2>

<?php
include 'form.php'; ?>

<?php


include 'footer.php';
?>