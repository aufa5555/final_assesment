<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessments - Student Grading</title>
</head>

<body>

    <?php

    include 'db.php';

    $search = $_GET['search'] ?? '';

    $Like = "%" . $search . "%";
    //$sql = $conn->prepare("SELECT * FROM result");
    $sql = $conn->prepare("SELECT * FROM result WHERE
    student_name LIKE ? OR
    matric_number LIKE ? OR
    subject_name LIKE ? OR
    subject_code LIKE ?
    ORDER BY student_name");

    $sql->bind_param("ssss", $Like, $Like, $Like, $Like);

    $sql->execute();
    $result = $sql->get_result();

    include 'header.php';

    ?>


    <h2>Student Records</h2>

    <a href="add.php">+Add Result</a>
    <br><br>
    <form method="get">
    <input type="text" name="search" placeholder="Search by name or id">
    <input type="submit" value="Search">
    <a href="index.php">Show all</a>
</form>
<br><br>
<table border="1">
            <tr>
                <th>No.</th>
                <th>Student Name</th>
                <th>Matric No.</th>
                <th>Subject</th>
                <th>Test 1(20%)</th>
                <th>Test 2(30%)</th>
                <th>Final(50%)</th>
                <th>Total (100%)</th>
                <th>Grade</th>
                <th>Action</th>

            </tr>
            <?php

            $count = 1;

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $count++ . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['matric_number'] . "</td>";
                echo "<td>" . $row['subject_name'] . "<br>(" . $row['subject_code'] . ")</td>";
                echo "<td>" . $row['test1'] . "</td>";
                echo "<td>" . $row['test2'] . "</td>";
                echo "<td>" . $row['final_examination'] . "</td>";
                echo "<td>" . $row['total_marks'] . "</td>";
                echo "<td>" . $row['final_grade'] . "</td>";

                echo "<td>";

                echo "<a href='edit.php?id=" . $row['id'] . "'>Edit</a> ";

                echo "<form method='post' action='delete.php' 
         onsubmit='return confirm(\"Delete this?\")'>";

                echo "<input type='hidden' name='delete' value='" . $row['id'] . "'>";

                echo "<input type='submit' value='Delete'>";

                echo "</form>";

                echo "</td>";
            }

            ?>
        </table>


</body>

<?php

if ($result->num_rows === 0)
    if ($search != "") {
        echo "<p>No records match for '$search'.</p>";
    } else {
        echo "<p>No records match.</p>";
    }
include 'footer.php';

?>
</form>
</body> 

</html>