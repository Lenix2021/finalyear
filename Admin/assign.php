
<?php
session_start();

$conn = mysqli_connect("localhost","root","","emoderation");



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
                        <LEGENd>ASSIGN MODERATOR</LEGENd>
                   
<table class = "table" style = "background-color:white;"  cellpadding="10">
                   <tr>
                    <th>S/NO</th>
                    <th>COURSE CODE</th>
                    <th>COURSE TITLE</th>
                    <th>LECTURER NAME</th>
</tr>
<?php

$sno = 1;
$sql = "select * from scheme";
$query_run = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($query_run)){
    ?>
    <tr>
    <td><?php echo $sno; ?></td>
    <td><?php echo $row['CID']; ?></td>
    <td><?php echo $row['C_TITLE']; ?></td>
    <td><?php echo $row['LNAME']; ?></td>   
    <td><a href="task.php?id=<?php echo $row['ID']; ?>">Assign</a></td>
    
    
</tr>
<?php
$sno +=1;
}


?>
</table>
                </fieldset>

                <fieldset >
                        <LEGENd>ALL ASSIGNED TASKS</LEGENd>
                   
<table class = "table" style = "background-color:white;"  cellpadding="10">
                   <tr style="gap:50px;color:blue;">
                    <th>S/NO</th>
                    <th>COURSE CODE</th>
                    <th>COURSE TITLE</th>
                    <th>ASSIGNED TO</th>
                    <th>DATE</th>

</tr>
<?php

$sno = 1;
$sql = "select * from task";
$query_run = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($query_run)){
    ?>
    <tr>
    <td><?php echo $sno; ?></td>
    <td><?php echo $row['C_CODE']; ?></td>
    <td><?php echo $row['C_TITLE']; ?></td>
    <td><?php $li = $row['LID'];
    $sql = "SELECT LNAME FROM lecturer WHERE LID = '$li'";
    $result = mysqli_query($conn, $sql);
     $Lrow = mysqli_fetch_assoc($result);
    echo $Lrow['LNAME']; ?></td>
    <td><?php echo $row['date']; ?></td>

    
</tr>
<?php
$sno +=1;
}


?>
</table>
                </fieldset>
             
    </main>


   
</body>
</html>
