<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadOk = 1;

    // Check if the file upload is from the first form (for /etc/board1.swu)
    if (isset($_FILES["fileToUploadBoard1"])) {
        $targetDir = "/etc/";
        $targetFile = $targetDir . "board1.swu";

        // Check for upload errors
        if ($_FILES["fileToUploadBoard1"]["error"] === UPLOAD_ERR_OK) {
            // Attempt to move the uploaded file to /etc/ with name board1.swu
            move_uploaded_file($_FILES["fileToUploadBoard1"]["tmp_name"], $targetFile);
        }
    }

    // Check if the file upload is from the second form (for /mnt/board2.swu)
    if (isset($_FILES["fileToUploadBoard2"])) {
        $targetDir = "/mnt/";
        $targetFile = $targetDir . "board2.swu";

        // Check for upload errors
        if ($_FILES["fileToUploadBoard2"]["error"] === UPLOAD_ERR_OK) {
            // Attempt to move the uploaded file to /mnt/ with name board2.swu
            move_uploaded_file($_FILES["fileToUploadBoard2"]["tmp_name"], $targetFile);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stryke</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FEF8F8;
        }
    </style>
</head>

<body>
    <div class="bg-info fs-1 d-flex py-4 px-3 text-black align-items-center border-bottom border-4 border-dark header">
        <img src="/html/html/assets/logo.png" alt="Logo" class="header-logo me-3" style="height: 60px;"> <!-- Adjust height as needed -->
    </div>

    <div class="d-flex section">
        <div class="d-flex flex-column w-200 bg-dark section-left">
            <a href="index.php" class="text-decoration-none py-4 px-3  text-white" data-content="">Home</a>
            <a href="#" class="text-decoration-none py-4 px-3 text-white dropdown-toggle" data-content="network">Network</a>

            <!-- Dropdown for Network Tabs -->
            <ul id="network-dropdown" class="dropdown" style="display: none;">
                <li><a href="wifi.php" class="text-decoration-none" data-content="wifi">WiFi</a></li>
                <li><a href="video.php" class="text-decoration-none" data-content="video">Video</a></li>

            </ul>

            <a href="logs.php" class="text-decoration-none py-4 px-3 text-white" data-content="logs">Log</a>
            <a href="upgrade.php" class="text-decoration-none py-4 px-3 text-white active" data-content="upgrade">Upgrade</a>
            <a href="system-info.php" class="text-decoration-none py-4 px-3 text-white" data-content="system-info">System Info</a>
            <a href="help.php" class="text-decoration-none py-4 px-3 text-white" data-content="help">Help</a>
            <a href="restart.php" class="text-decoration-none py-4 px-3 text-white " data-content="restart">Restart</a>
        </div>
        <div>
            <!-- Form to upload file to /etc/ with name board1.swu -->
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- <label for="fileToUploadBoard1">Uploading/......................</label> -->
                <input type="file" name="fileToUploadBoard1" required>
                <button type="submit">Upload</button>
            </form>

            <!-- Form to upload file to /mnt/ with name board2.swu -->
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- <label for="fileToUploadBoard2">Uploading.................</label> -->
                <input type="file" name="fileToUploadBoard2" required>
                <button type="submit">Upload</button>
            </form>
            <script src="script.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>