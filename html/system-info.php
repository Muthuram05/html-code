<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stryker</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="assets/jquery-3.7.1.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FEF8F8;
        }

        .disable {
            display: none;
        }
        .card-header{
            background-color: red !important;
        }
    </style>
</head>

<body>
    <div class="bg-info fs-1 d-flex py-4 px-3 text-black align-items-center border-bottom border-4 border-dark header">
        <img src="/html/html/assets/logo.png" alt="Logo" class="header-logo me-3" style="height: 60px;">
        <!-- Adjust height as needed -->
    </div>

    <div class="d-flex section">
        <div class="d-flex flex-column w-200 bg-dark section-left">
            <a href="index.php" class="text-decoration-none py-4 px-3 text-white">Home</a>
            <a href="#" class="text-decoration-none py-4 px-3 text-white dropdown-toggle">Network</a>
            <ul id="network-dropdown" class="dropdown" style="display: none;">
                <li><a href="wifi.php" class="text-decoration-none">WiFi</a></li>
                <li><a href="video.php" class="text-decoration-none">Video</a></li>
            </ul>
            <a href="logs.php" class="text-decoration-none py-4 px-3 text-white">Log</a>
            <a href="upgrade.php" class="text-decoration-none py-4 px-3 text-white">Upgrade</a>
            <a href="system-info.php" class="text-decoration-none py-4 px-3 text-white active">System Info</a>
            <a href="help.php" class="text-decoration-none py-4 px-3 text-white">Help</a>
            <a href="restart.php" class="text-decoration-none py-4 px-3 text-white">Restart</a>
        </div>

        <div class="container py-1">
            <h2>System Information</h2>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">System Parameters</h5>
                </div>
                <div class="card-body">
                    <p><strong>Manufacturing Date:</strong> 2024-01-15</p>
                    <p><strong>Serial Number:</strong> ABC123456789</p>
                    <p><strong>Software Versions:</strong> v1.2.3</p>
                    <p><strong>PCBA Number:</strong> PCBA456789</p>
                    <p><span>Mac Address :</span><span id="eth0">please wait</span></p>
                    <p><strong>Memory Utilization:</strong> 45%</p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header d-flex">
                    <h5 class="card-title">Monitor Performance Parameters</h5>

                </div>
                <div class="card-body">
                    <div id="performanceParameters" style="display: none;">
                        <p><strong>Frame Drop:</strong> Average 2 frames</p>
                        <p><strong>Latency:</strong> 60 ms</p>
                        <p><strong>WiFi Bandwidth:</strong> <span id="bandwidth"></span> Mbps</p>
                        <p><strong>Internet Speed:</strong> <span id="speed">Calculating...</span></p>
                    </div>

                    <div class="mb-3" id="setDisable">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="text" id="password" class="form-control" placeholder="Enter password" />
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">Show</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const togglePasswordButton = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const performanceParameters = document.getElementById('performanceParameters');
        const setDisable = document.getElementById('setDisable');

        togglePasswordButton.addEventListener('click', () => {
            const enteredPassword = passwordInput.value;
            if (enteredPassword === 'stryker') {
                performanceParameters.style.display = 'block';

                setDisable.classList.add("disable")
            } else {
                alert('Incorrect password. Please try again.');
                passwordInput.value = '';
            }
        });
    </script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
</body>

</html>