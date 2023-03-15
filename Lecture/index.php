
<?php
session_start();

$conn = mysqli_connect("localhost","root","","emoderation");


if (!isset($_SESSION['id'])) {
    header("Location:../");
    exit();
}
$key = $_SESSION['id'];

 // Retrieve the corresponding lecturer's name
 $sql = "SELECT LNAME FROM lecturer WHERE LID = '$key'";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 $lname = $row['LNAME'];



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
            <li title="Click here to add lectures or courses"><a href="./index.php">Upload </a></li>
            <li title="Click here to add lectures or courses"><a href="./moderate.php">Moderate</a></li>
            <li title="Click here to assign lectures to courses"><a href="#">Approve</a></li>
            <li title="Click here to print"><a href="#">Print</a></li>
            <li title="Click here to change password"><a href="./changepwd.php">Change Password</a></li>

        </ul>
        <h4><?php echo "Welcome"." ".$lname      ?></h4>
        <button onclick="location.href='../logout.php'">Logout</button>
    </nav>
    <main>
    <div class="forms">
               <form method = 'post'>
                <div class="file">
                    <fieldset >
                        <LEGENd>UPLOAD</LEGENd>
                   
<table class = "table" style = "background-color:white;"  cellpadding="10">
                   <tr>
                    <th>S/NO</th>
                    <th>COURSE CODE</th>
                    <th>COURSE TITLE</th>
</tr>
<?php

$sno = 1;
$sql = "select id, C_CODE , C_TITLE from courses where LID = '$key'";
$query_run = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($query_run)){
    ?>
    <tr>
    <td><?php echo $sno; ?></td>
    <td><?php echo $row['C_CODE']; ?></td>
    <td><?php echo $row['C_TITLE']; ?></td>
    <td> <td>
     <?php
   $id = $row['id'];

   // Base64 encode the ID value
$encoded_id = base64_encode($id);

$link = "file.php?p=$encoded_id";   
echo "<a href='$link'>Upload Question";?></td>
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
