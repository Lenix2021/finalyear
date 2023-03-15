<?php
session_start();
// Establish a database connection
$conn = mysqli_connect("localhost", "root","", "emoderation");

if (!isset($_SESSION['id'])) {
    header("Location:../");
    exit();
}
$key = $_SESSION['id'];

// Retrieve the course ID from the URL parameter
$encoded_id = $_GET['p'];

 // Decode the ID value
 $course_id = base64_decode($encoded_id);

     // Check if the form has been submitted
     if (isset($_POST['upload'])) {
        // Retrieve the form data
        $cid = $_POST['cid'];
        $n = $_POST['cname'];
    
        // Retrieve the corresponding lecturer's name
        $sql = "SELECT LNAME FROM lecturer WHERE LID = '$key'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $lname = $row['LNAME'];
    
        if (isset($_FILES['pdfFile'])) {
            $file = $_FILES['pdfFile'];
    
            // Check for errors
            if ($file['error'] !== UPLOAD_ERR_OK) {
                echo "Error uploading file.";
                exit();
            }
    
            // Get the file extension
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
            // Check if the file is a PDF
            if ($extension !== "pdf") {
                echo "Please upload a PDF file.";
                exit();
            }
    
            // Set the target directory and filename
            $target_dir = "C:/xampp/htdocs/finalyear/Files/";
            $target_file = $target_dir . basename($file['name']);
    
            //set file path
            $file_path = $target_file;
    
            // Check if the file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
            } else {
                // Move the file to the target directory
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    echo "File uploaded successfully.";
                    // Insert the file path into the database
                    $sql = "INSERT INTO scheme(C_TITLE,CID,LNAME,LID,FILE) VALUES ('$n','$cid','$lname','$key','$target_file')";
                    if ($conn->query($sql) === TRUE) {
                        $query = "DELETE FROM courses where ID = '$course_id'";
                        $result = mysqli_query($conn, $query);


                         // Redirect the user back to the assign list page
                        header("Location: index.php");
                         exit();


                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Error uploading file.";
                }
            }
        } else {
            echo "Please select a file to upload.";
        }
    }
    
    // Retrieve the course record from the database
    $query = "SELECT * FROM courses WHERE id = $course_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Close database connection
    $conn->close();
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
            <li title="Click here to assign lectures to courses"><a href="#">Assign Moderator</a></li>
            <li title="Click here to print"><a href="#">Print</a></li>
            <li title="Click here to change password"><a href="./changepwd.php">Change Password</a></li>

        </ul>
        <button onclick="location.href='../logout.php'">Logout</button>
    </nav>
    <main>
       
            <div class="forms">
               <form method = 'post' enctype="multipart/form-data">
                  <div class="file">
                    <fieldset>
                        <legend>UPLOAD</legend>
                        <p>Course Code</p>
                        <input type="text" name="cid" value="<?php echo $row['C_CODE']; ?>" required readonly><br>
                        <p>Course Title</p>
                        <input type="text" name="cname" value="<?php echo $row['C_TITLE']; ?>" required readonly><br> 
                       <input type="file" name="pdfFile" accept=".pdf">
                        <br>
                        <input type="submit" value="UPLOAD" name="upload"> 
                      </fieldset>
       
                  </div>
   
               </form>

                      </fieldset>
             </div>
    </main>
   
</body>
</html>