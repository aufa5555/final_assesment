<?php
include 'header.php';
include 'db.php';

$id = $_GET['id'];

$sql = $conn->prepare("SELECT * FROM result WHERE id = $id");
$sql->execute();

$row =  $sql->get_result()->fetch_assoc();

$student_name = $row['student_name'];
$matric_number = $row['matric_number'];
$subject_name = $row['subject_name'];
$subject_code = $row['subject_code'];
$test1 = $row['test1'];
$test2 = $row['test2'];
$final_examination = $row['final_examination'];

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

    $sql = $conn->prepare("UPDATE 
    result SET student_name='$student_name', matric_number='$matric_number', subject_name='$subject_name', subject_code='$subject_code', test1='$test1', test2='$test2', final_examination='$final_examination', final_grade='$final_grade', total_marks='$total' WHERE id=$id");

    if ($sql->execute())
        header("Location: index.php");
    exit;
}
?>

<h2>Edit Result</h2>


<?php
include 'form.php';
include 'footer.php';
?>