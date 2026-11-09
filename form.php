<style>
label {
    display: inline-block;
    width: 200px;
}
</style>

<form method="post">
    <label for="student_name">Student Name:</label>
    <input type="text" name="student_name" value="<?php echo $student_name;?>">
    <br><br>
    <label for="matric_number">Matric No.:</label>
    <input type="text"  name="matric_number" value="<?php echo $matric_number;?>">
    <br><br>
    <label for="subject_name">Subject:</label>
    <input type="text"  name="subject_name" value="<?php echo $subject_name;?>">
    <br><br>
    <label for="subject_code">Subject Code:</label>
    <input type="text" name="subject_code"value="<?php echo $subject_code;?>">
    <br><br>
    <label for="test1">Test 1 (20%):</label>
    <input type="number"  name="test1"value="<?php echo $test1;?>">out of 20
    <br><br>
    <label for="test2">Test 2 (30%):</label>
    <input type="number"  name="test2" value="<?php echo $test2;?>"> out of 30
    <br><br>
    <label for="final_examination">Final (50%):</label>
    <input type="number" name="final_examination" value="<?php echo $final_examination;?>"> out of 50
    <br><br>
    <input type="Submit" name="Submit" value="Submit">
</form>