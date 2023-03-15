
<?php

$conn = mysqli_connect("localhost","root","","emoderation");
if(isset($_POST['submit'])){

$id = $_POST['id'];
$n = $_POST['user'];
$pwd = $_POST['password'];
$dep = $_POST['dep'];
$g = $_POST['gender'];
$r = $_POST['rank'];

// Check if Lecturer already exists in the database
$query = "SELECT LID, LNAME FROM lecturer WHERE LID = '$id' OR LNAME = '$n'";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

if($count > 0) {
    // If course already exists, output an error message
    echo "Error: Lecturer already exists in the database";
}

else {

$sql = "INSERT INTO lecturer (LID, LNAME, PWD,dep,gender,rank)
VALUES ('$id', '$n', '$pwd', '$dep', '$g', '$r')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";

} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

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
                        <LEGENd>ADD LECTURER</LEGENd>
                   
                        <p>UserID</p>
                        <input type="text" name="id"  required>
                        <p>Username</p>
                        <input type="text" name="user" placeholder="Enter Username" required>
                        <p>Password</p>
                        <input type="password" name="password" placeholder="********" required>
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
                              <input type="radio" name="gender" value="male">
                              Male
                            </label>
                            <label>
                              <input type="radio" name="gender" value="female">
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
                        <input type="submit" value="SAVE" name="submit"> <br>
                </fieldset>
                </div>
                  
                   
               </form>
           
                <br>
                <br>
               <fieldset >
                        <LEGENd>VIEW LECTURERS</LEGENd>
                        
                   <table  cellpadding="10" >
                   <tr style="gap:50px;color:blue;">
                    <th>S/NO</th>
                    <th>LECTURER ID</th>
                    <th>LECTURER NAME</th>
                    <th>GENDER</th>
                    <th>DEPARTMENT</th>
                    <th>RANK</th>

</tr>
<?php

$sql = "select * from lecturer limit 10";
$query_run = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($query_run)){
    ?>
    <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['LID']; ?></td>
    <td><?php echo $row['LNAME']; ?></td>
    <td><?php echo $row['gender'] ?></td>
    <td><?php echo $row['dep'] ?></td>
    <td><?php echo $row['rank'] ?></td>
    <td><a href="editlecturer.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a></td>
</tr>
<?php
}


?>
</table>
                      
                </fieldset>
             </div>
    </main>


   
</body>
</html>