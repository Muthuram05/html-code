<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stryker</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="assets/wifi.css">
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <style>
        .fm {
            width: 800px;
            align-items: center;

        }

        .button {
            color: #DBA92C;
            background-color: darkgoldenrod;

        }

        button:hover {
            background: #DBA92C;
            /* Background color on hover for all links */
        }
        body {
            background-color: #FEF8F8;
        }
  
    </style>
    <script>
        function submitForm() {
            const ipAddressB1 = document.getElementById('ipAddressB1').value;
            const portB1 = document.getElementById('portB1').value;
            const ipAddressB2 = document.getElementById('ipAddressB2').value;
            const portB2 = document.getElementById('portB2').value;

            // Get the checkbox elements
            const wifi1AChecked = document.getElementById('wifi1A').checked;
            const wifi2AChecked = document.getElementById('wifi2A').checked;
            const wifi1BChecked = document.getElementById('wifi1B').checked;
            const wifi2BChecked = document.getElementById('wifi2B').checked;
            const loopoutChecked = document.getElementById('loopout').checked; // Board 1 loopout
            const loopoutb2Checked = document.getElementById('loopoutb2').checked; // Board 2 loopout

            // Initialize the configuration object
            const config = {
                "ipAddressB1": ipAddressB1,
                "portB1": portB1,
                "ipAddressB2": ipAddressB2,
                "portB2": portB2,
                "26": "", // For Board 1 WiFi
                "27": "", // For Board 2 WiFi
                "21": "", // For Board 1 loopout
                "24": "" // For Board 2 loopout
            };

            // Determine the value for Board 1 WiFi
            if (wifi1AChecked && wifi2AChecked) {
                config["26"] = "3";
            } else if (wifi1AChecked) {
                config["26"] = "1";
            } else if (wifi2AChecked) {
                config["26"] = "2";
            }

            // Determine the value for Board 2 WiFi
            if (wifi1BChecked && wifi2BChecked) {
                config["27"] = "3";
            } else if (wifi1BChecked) {
                config["27"] = "1";
            } else if (wifi2BChecked) {
                config["27"] = "2";
            }

            // Handle loopout for Board 1 (21)
            if (loopoutChecked) {
                config["21"] = "1";
            }

            // Handle loopout for Board 2 (24)
            if (loopoutb2Checked) {
                config["24"] = "1";
            }

            // Send the data to the PHP script
            fetch('modify.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(config)
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert(data.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        function showAdvancedSettings() {
            window.location.href = 'advance_setting.php';
        }
    </script>
</head>

<body>
<div class="bg-info fs-1 d-flex py-4 px-3 text-black align-items-center border-bottom border-4 border-dark header">
        <img src="/html/html/assets/logo.png" alt="Logo" class="header-logo me-3" style="height: 60px;"> <!-- Adjust height as needed -->
    </div>

    <div class="d-flex section">
        <div class="d-flex flex-column w-200 bg-dark section-left">
            <a href="index.php" class="text-decoration-none py-4 px-3 text-white">Home</a>
            <a href="#" class="text-decoration-none py-4 px-3 text-white dropdown-toggle active">Network</a>
            <!-- Network Tabs -->
            <ul id="network-dropdown" class="dropdown" style="display: none;">
                <li><a href="wifi.php" class="text-decoration-none">WiFi</a></li>
                <li><a href="video.php" class="text-decoration-none active">Video</a></li>
            </ul>
            <a href="logs.php" class="text-decoration-none py-4 px-3 text-white">Log</a>
            <a href="upgrade.php" class="text-decoration-none py-4 px-3 text-white">Upgrade</a>
            <a href="system-info.php" class="text-decoration-none py-4 px-3 text-white">System Info</a>
            <a href="help.php" class="text-decoration-none py-4 px-3 text-white">Help</a>
            <a href="restart.php" class="text-decoration-none py-4 px-3 text-white">Restart</a>
        </div>
        <form class="fm">
            <div class="container mt-5">
                <div class="card-header">
                    <h5>UDP Stream HDMI 1</h5>
                </div>

                <!-- UDP Stream B1 -->
                <div class="card-body">
                    <div class="mb-3 d-flex">
                        <label for="ipAddressB1" class="form-label">IP Address</label>
                        <input type="text" class="form-control" id="ipAddressB1" placeholder="Enter the IP address">
                    </div>
                    <div class="mb-3 d-flex">
                        <label for="portB1" class="form-label">Port</label>
                        <input type="number" class="form-control" id="portB1" placeholder="Enter the port" min="1000"
                            max="9999">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="loopout">
                        <label class="form-check-label" for="loopout">Loopout</label>
                    </div>
                    <div class="d-flex">
                        <h6>Output Interface</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="wifi1A">
                            <label class="form-check-label" for="wifi1A">wifi1A</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="wifi2A">
                            <label class="form-check-label" for="wifi2A">wifi2A</label>
                        </div>
                    </div>
                </div>
                <!-- UDP Stream B2 -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>UDP Stream HDMI2</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex">
                            <label for="ipAddressB2" class="form-label">IP Address</label>
                            <input type="text" class="form-control" id="ipAddressB2" placeholder="Enter the IP address">
                        </div>
                        <div class="mb-3 d-flex">
                            <label for="portB2" class="form-label">Port</label>
                            <input type="number" class="form-control" id="portB2" placeholder="Enter the port" min="1"
                                max="65535">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="loopoutb2">
                            <label class="form-check-label" for="loopoutb2">Loopout</label>
                        </div>
                        <div class="d-flex">


                            <h6>Output Interface</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="wifi1B">
                                <label class="form-check-label" for="wifi1B">wifi1B</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="wifi2B">
                                <label class="form-check-label" for="wifi2B">wifi2B</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn  button" onclick="submitForm()">Submit</button>
                    <button type="button" class="btn button" onclick="showAdvancedSettings()">Advanced
                        Settings</button>
                </div>

            </div>
        </form>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="assets/bootstrap.min.js"></script>
</body>

</html>