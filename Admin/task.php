<?php

session_start();


// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "emoderation");

// Retrieve the course ID from the URL parameter
$tk_id = $_GET['id'];

// Check if the form has been submitted
if (isset($_POST['assign'])) {
    // Retrieve the form data
    $cid = $_POST['cid'];
    $n = $_POST['cname'];
    $lid = $_POST['id'];
    $d = $_POST['date'];

         // Retrieve the corresponding file
         $sql = "SELECT LID, FILE FROM scheme WHERE ID = '$tk_id'";
         $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
         $filepath = $row['FILE'];
         $sid = $row['LID'];

    // Insert into the database
   
    if($lid === $sid)
    {
        echo "Error!!!..Cannot assign a lecturer his/her own course";
    }

    elseif($lid === 'Select Lecturer')
    {
        echo "Error!!!!!..Lecturer not Selected,Please select lecturer ";
    }

    else{
        $query = "INSERT INTO task (C_CODE, C_TITLE, LID,file,date) VALUES ('$cid', '$n', '$lid','$filepath','$d')";
        $result = mysqli_query($conn, $query);

        $query = "DELETE FROM scheme where ID = '$tk_id'";
        $result = mysqli_query($conn, $query);


        // Redirect the user back to the assign list page
        header("Location: assign.php");
        exit();
    }
   
}


// Retrieve the record from the database
$query = "SELECT * FROM scheme WHERE ID = $tk_id";
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
                        <legend>Assign Moderator</legend>
                        <p>Course Code</p>
                        <input type="text" name="cid" value="<?php echo $row['CID']; ?>" required readonly><br>
                        <p>Course Title</p>
                        <input type="text" name="cname" value="<?php echo $row['C_TITLE']; ?>" required readonly><br> 
                        <span class="select_idt">Name Of Moderator</span>
                         <br>
                        <select  class="opt" name = "id" required>
                         <option>Select Lecturer</option>
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
                        <p>Date</p>
                        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required readonly>
                        <br>
                        <input type="submit" value="ASSIGN" name="assign"> 
                      </fieldset>
       
                  </div>
   
               </form>

                      </fieldset>
             </div>
    </main>
   
</body>
</html>