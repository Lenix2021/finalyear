<?php

session_start();


// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "emoderation");

// Retrieve the course ID from the URL parameter
$course_id = $_GET['id'];

// Check if the form has been submitted
if (isset($_POST['update'])) {
    // Retrieve the form data
    $cid = $_POST['cid'];
    $n = $_POST['cname'];
    $lid = $_POST['id'];

        // Retrieve the corresponding lecturer's name
        $sql = "SELECT LNAME FROM lecturer WHERE LID = '$lid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $lname = $row['LNAME'];

        if($lid == 0)
        {
         
            echo"ERROR!!!!!..Lecturer not Selected ";
        
        }
    
    else
    {    
        // Update the course record in the database
    $query = "UPDATE courses SET C_CODE = '$cid', C_TITLE = '$n', LID = '$lid', LNAME = '$lname' WHERE id = $course_id";
    $result = mysqli_query($conn, $query);
    

    // Redirect the user back to the courses list page
    header("Location: courses.php");
    exit();
    }
}


// Retrieve the course record from the database
$query = "SELECT * FROM courses WHERE id = $course_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);



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
            <li title="Click here to add lectures or courses"><a href="./addcourses.php">Add Courses</a></li>
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
                        <legend>EDIT COURSE</legend>
                        <p>Course Code</p>
                        <input type="text" name="cid" value="<?php echo $row['C_CODE']; ?>" required><br>
                        <p>Course Title</p>
                        <input type="text" name="cname" value="<?php echo $row['C_TITLE']; ?>" required><br> 
                        <span class="select_idt">Name Of Examiner</span>
                         <br>
                        <select  class="opt" name = "id" required>
                         <option value = 0>Select Lecturer</option>
                         <?php
                         $conn = mysqli_connect("localhost","root","","emoderation");
                    // Prepare a select statement
                    $sql = "SELECT LID,LNAME FROM lecturer";

                    $query_run = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($query_run)){
while($ro = mysqli_fetch_assoc($query_run)){
    ?>

    <option value = "<?php echo $ro['LID']; ?>"
    ><?php echo $ro['LNAME']; ?></option>
    
    <?php

}                    }
                    ?>
                   
                        </select>
                        <br>
                        <input type="submit" value="UPDATE" name="update"> 
                      </fieldset>
       
                  </div>
   
               </form>

                      </fieldset>
             </div>
    </main>
   
</body>
</html>
