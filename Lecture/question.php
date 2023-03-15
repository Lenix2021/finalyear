<?php

// connect to the database
$conn = mysqli_connect("localhost","root","","emoderation");


 $encoded_id = $_GET['p'];

  // Decode the ID value
$qid = base64_decode($encoded_id);



// check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// get the file path from the database
$sql = "SELECT file FROM task WHERE id = '$qid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $file_path = $row["file"];
} else {
  echo "File not found";
}

// read the contents of the PDF file
$contents = file_get_contents($file_path);



// close the database connection
$conn->close();


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>E-Moderation</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
  <style>
    #pdf-viewer {
      width: 100%;
      height: 100vh;
    }
  </style>
</head>
<body>
  <iframe id="pdf-viewer"></iframe>
  <button id="zoom-in">Zoom In</button>
  <button id="zoom-out">Zoom Out</button>
  <script>
    // initialize the PDF viewer
    const pdfViewer = document.getElementById('pdf-viewer');
    pdfjsLib.getDocument({ data: atob("<?php echo base64_encode($contents); ?>") })
      .promise.then(pdf => {
        let scale = 1.0;
        const numPages = pdf.numPages;
        let pageNumber = 1;
        function renderPage() {
          pdf.getPage(pageNumber).then(page => {
            const viewport = page.getViewport({ scale });
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            const renderContext = {
              canvasContext: context,
              viewport: viewport
            };
            page.render(renderContext).promise.then(() => {
              pdfViewer.contentWindow.document.body.appendChild(canvas);
              if (pageNumber < numPages) {
                pageNumber++;
                renderPage();
              }
            });
          });
        }
        renderPage();

        // add event listener for zoom in button
        document.getElementById('zoom-in').addEventListener('click', () => {
          scale += 0.1;
          pageNumber = 1;
          pdfViewer.contentWindow.document.body.innerHTML = '';
          renderPage();
        });

        // add event listener for zoom out button
        document.getElementById('zoom-out').addEventListener('click', () => {
          if (scale > 0.2) {
            scale -= 0.1;
            pageNumber = 1;
            pdfViewer.contentWindow.document.body.innerHTML = '';
            renderPage();
          }
        });
      });
  </script>
</body>
</html>
