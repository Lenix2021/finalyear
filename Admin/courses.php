<?php

$conn = mysqli_connect("localhost","root","","emoderation");
if(isset($_POST['send'])) {
    $cid = $_POST['cid'];
    $n = $_POST['cname'];
    $id = $_POST['id'];
    
    // Check if course already exists in the database
    $query = "SELECT C_CODE, C_TITLE FROM courses WHERE C_CODE = '$cid'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    if($count > 0) {
        // If course already exists, output an error message
        echo "Error: Course already exists in the database";
    } else {
        // Retrieve the corresponding lecturer's name
        $sql = "SELECT LNAME FROM lecturer WHERE LID = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $lname = $row['LNAME'];


$sq = "INSERT INTO courses (C_CODE, C_TITLE, LID, LNAME) VALUES ('$cid', '$n', '$id', '$lname')";
  if (mysqli_query($conn, $sq)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sq . "<br>" . mysqli_error($conn);
            
        }
    }

    mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Moderation Webapp</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/ht.jpg" type="image/x-icon">
</head>
<body>
    <nav>
        <h1>E-MODERATE</h1>

        <ul>
            <li title="Click here to add lectures or courses"><a href="./index.php">Add Lectures</a></li>
            <li title="Click here to add lectures or courses"><a href="./courses.php">Add Courses</a></li>
            <li title="Click here to assign lectures to courses"><a href="assign.php">Assign Moderator</a></li>
            <li title="Click here to print"><a href="#">Print</a></li>
            <li title="Click here to change password"><a href="./changepwd.php">Change Password</a></li>

        </ul>
        <input type="button" onclick="location.href='../logout.php'" value="Logout">
    </nav>
    <main>
       
            <div class="forms">
               <form method = 'post'>
                  <div class="file">
                    <fieldset>
                        <legend>ADD COURSE</legend>
                        <p>Course Code</p>
                        <input type="text" name="cid"  required>
                        <p>Course Title</p>
                        <input type="text" name="cname" placeholder="Course Title" required>
                        <br>
                        <span class="select_idt">Name Of Examiner</span>
                         <br>
                        <select  class="opt" name = "id">
                         <option>Select Lecturer</option>
                         <?php
                         $conn = mysqli_connect("localhost","root","","emoderation");
                    // Prepare a select statement
                    $sql = "SELECT LID,LNAME FROM lecturer";

                    $query_run = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($query_run)){
while($row = mysqli_fetch_assoc($query_run)){
    ?>

    <option value = "<?php echo $row['LID']; ?>"
    ><?php echo $row['LNAME']; ?></option>
    
    <?php

}                    }
                    ?>
                   
                        </select>
                        <br>
                        <input type="submit" value="SAVE" name="send"> 
                      </fieldset>
       
                  </div>
   
               </form>

               <fieldset>
                        <legend>VIEW COURSES</legend>
                        <table class = "table" style = "background-color:white;"  cellpadding="10">
                   <tr style="gap:50px;color:blue;">
                    <th>S/NO</th>
                    <th>COURSE CODE</th>
                    <th>COURSE TITLE</th>
                    <th>LECTURER ID</th>
                    <th>LECTURER NAME</th>
</tr>
<?php
$sno =1;
$sql = "select * from courses";
$query_run = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($query_run)){
    ?>
    <tr>
    <td><?php echo $sno ?></td>
    <td><?php echo $row['C_CODE']; ?></td>
    <td><?php echo $row['C_TITLE']; ?></td>
    <td><?php echo $row['LID']; ?></td>
    <td><?php echo $row['LNAME']; ?></td>
   <td><a href="editcourse.php?id=<?php echo $row['id']; ?>">Edit</a></td>
</tr>
<?php
$sno +=1;
}


?>
</table>
                      </fieldset>
             </div>
    </main>
   
</body>
</html>