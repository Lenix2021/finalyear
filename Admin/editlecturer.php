
<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "emoderation");

// Retrieve the course ID from the URL parameter
$lec_id = $_GET['id'];

// Check if the form has been submitted
if (isset($_POST['update'])) {
    // Retrieve the form data
    $lid = $_POST['id'];
    $n = $_POST['user'];
    $dep = $_POST['dep'];
$g = $_POST['gender'];
$r = $_POST['rank'];

if($lid == 0)
{
 
    echo"ERROR!!!!!..Lecturer ID cannot be 0";

}
else{

    // Update the lecturers record in the database
    $query = "UPDATE lecturer SET LID = '$lid', LNAME = '$n', dep = '$dep',gender = '$g',rank = '$r'  WHERE id = $lec_id";
    $result = mysqli_query($conn, $query);


    // Redirect the user back to the lecturer list page
    header("Location: index.php");
    exit();
}
}


// Retrieve the lecturers record from the database
$query = "SELECT * FROM lecturer WHERE id = $lec_id";
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
            <li title="Click here to add lectures or courses"><a href="./index.php">Add Lecturers</a></li>
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
                    <fieldset >
                        <LEGENd>EDIT LECTURER</LEGENd>
                   
                        <p>UserID</p>
                        <input type="text" name="id" value = "<?php echo $row['LID']; ?>"  required>
                        <p>UserName</p>
                        <input type="text" name="user" value = "<?php echo $row['LNAME']; ?>" required>

                        <br>
                        <span class="select_idt">Department</span>
                         <br>
                        <select  class="opt" name = "dep">
                         <option>Select Department</option>
                         <option value="Computer Science">Computer Science</option>
                        </select>
</br>
<br>
<label>
  <input type="radio" name="gender" value="Male">
  Male
</label>
<label>
  <input type="radio" name="gender" value="Female">
  Female
</label>
<br>
<br>
                        <span class="select_idt">Rank</span>
                         <br>
                        <select  class="opt" name = "rank">
                         <option>Select Rank</option>
                         <option value="Junior Lecturer">Junior Lecturer</option>
                         <option value="Senior Lecturer">Senior Lecturer</option>
                         <option value="Computer Science">Computer Science</option>
                         <option value="Computer Science">Computer Science</option>
                         <option value="Computer Science">Computer Science</option>
                         <option value="Computer Science">Computer Science</option>
                        </select>
<br>




                        <input type="submit" value="UPDATE" name="update"> <br>
                </fieldset>
                </div>

   
               </form>
             </div>
    </main>


   
</body>
</html>