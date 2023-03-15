<?php
session_start();
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "emoderation");

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location:../");
    exit();
}

// Retrieve the current user's ID from the session
$user_id = $_SESSION['admin'];
// Retrieve the current user's information from the database
$query = "SELECT PWD FROM admin WHERE ANAME = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if (isset($_POST['change'])) {
    // Retrieve the form data
    $old_password = $_POST['oldpwd'];
    $new_password = $_POST['newpwd'];
    $confirm_password = $_POST['conpwd'];

    // Verify the old password
    if ($old_password === $user['PWD']) {
        // Verify the new password and confirm password match
        if ($new_password === $confirm_password) {
            // Update the user's password in the database
            $sql = "UPDATE admin SET PWD = '$new_password' WHERE ANAME = '$user_id'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Password updated successfully
                echo "Password has been updated successfully";
                // Redirect the user to the home page
                header("Location: index.php");
                exit();
            } else {
                // Display an error message
                echo "Unable to update password. Please try again later.";
            }
        } else {
            // Display an error message
            echo "New password and confirm password do not match.";
        }
    } else {
        // Display an error message
        echo "Incorrect old password.";
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
               <form method = "post">
                <div class="file">
                    <fieldset>
                      <legend>Change Password</legend>
                            <p>Old Password</p>
                            <input type="password" name="oldpwd" placeholder="********" required>
                            <p>New Password</p>
                            <input type="password" name="newpwd" placeholder="********" required>
                            <p>Confirm Password</p>
                            <input type="password" name="conpwd" placeholder="********" required>
                            <input type="submit" value="SAVE" name="change"> <br>
                    </fieldset>  
            </div>
   
               </form>
    </main>
   
</body>
</html>
