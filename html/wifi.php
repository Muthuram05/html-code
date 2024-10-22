<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stryker</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="assets/wifi.css">
    <style>
        .button {
            background-color: #DB9704;
            border: none;
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
            <a href="#" class="text-decoration-none py-4 px-3 text-white dropdown-toggle"
                data-content="network">Network</a>

            <!-- Dropdown for Network Tabs -->
            <ul id="network-dropdown" class="dropdown" style="display: none;">
                <li><a href="wifi.php" class="text-decoration-none active" data-content="wifi">WiFi</a></li>
                <li><a href="video.php" class="text-decoration-none" data-content="video">Video</a></li>

            </ul>

            <a href="logs.php" class="text-decoration-none py-4 px-3 text-white" data-content="logs">Log</a>
            <a href="upgrade.php" class="text-decoration-none py-4 px-3 text-white" data-content="upgrade">Upgrade</a>
            <a href="system-info.php" class="text-decoration-none py-4 px-3 text-white"
                data-content="system-info">System Info</a>
            <a href="help.php" class="text-decoration-none py-4 px-3 text-white" data-content="help">Help</a>
            <a href="restart.php" class="text-decoration-none py-4 px-3 text-white" data-content="restart">Restart</a>
        </div>

        <div class="py-4 px-3" style="width:100%">
            <div class="d-flex t-container align-items-center">
                <!-- First Frame: WiFi selection -->

                <div class="frame t-height" id="networkForm2">

                    <h3>Hospital Network Connection</h3>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="network1" id="disable" value="disable"
                            checked onclick="loadWifiSettings('frame6', '1')">
                            <label class="form-check-label" for="disable">Disable</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="network1" id="wifi1a1" value="WiFi 1A"
                                 onclick="loadWifiSettings('frame2', '1')">
                            <label class="form-check-label" for="wifi1a1">WiFi 1A</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="network1" id="wifi1b1" value="WiFi 1B"
                                onclick="loadWifiSettings('frame3', '1')">
                            <label class="form-check-label" for="wifi1b1">WiFi 1B</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="network1" id="wifi2a1" value="WiFi 2A"
                                onclick="loadWifiSettings('frame4', '1')">
                            <label class="form-check-label" for="wifi2a1">WiFi 2A</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="network1" id="wifi2b1" value="WiFi 2B"
                                onclick="loadWifiSettings('frame5', '1')">
                            <label class="form-check-label" for="wifi2b1">WiFi 2B</label>
                        </div>
                    </div>

                    <table>
                        <tr>
                            <td><label for="ssidInput" class="form-label">SSID</label></td>
                            <td><input type="text" class="form-control" id="ssidInput" style="width: 350px;"
                                    placeholder="Enter SSID"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><label for="passwordInput" class="form-label">Password</label></td>
                            <td><input type="text" class="form-control" id="passwordInput"
                                    placeholder="Enter Password" minlength="8" required></td>

                        </tr>
                        <td><button type="button" class="btn button" onclick="enableNetwork()">Enable</button>
                            </tbody>
                    </table>

                </div>
            </div>

            <div class="d-flex frame-align ">
                <div class="frame2 check" id="wifiSettings1">
                    <h3>WiFi 1A 5GHz</h3>

                    <!-- WiFi Name Input Field -->
                    <div class="mb-3">
                        <label for="wifiNameInput1" class="form-label">WiFi Name</label>
                        <input type="text" class="form-control" id="wifiNameInput1" placeholder="Enter WiFi Name">
                    </div>

                    <!-- WiFi Password Input Field -->
                    <div class="mb-3">
                        <label for="wifiPasswordInput1" class="form-label">WiFi Password</label>
                        <input type="text" class="form-control" id="wifiPasswordInput1"
                            placeholder="Enter WiFi Password">
                    </div>

                    <!-- Enable Button -->
                    <button type="button" class="btn button  mt-3" onclick="enableHotspot('1')">Enable</button>
                    <button type="button" class="btn button mt-3" onclick="enableHotspot('2')">Disable</button>
                </div>
                <div class="frame3 check" id="wifiSettings2">
                    <h3>WiFi 1B 2.4GHz</h3>

                    <!-- WiFi Name Input Field -->
                    <div class="mb-3">
                        <label for="wifiNameInput2" class="form-label">WiFi Name</label>
                        <input type="text" class="form-control" id="wifiNameInput2" placeholder="Enter WiFi Name">
                    </div>

                    <!-- WiFi Password Input Field -->
                    <div class="mb-3">
                        <label for="wifiPasswordInput2" class="form-label">WiFi Password</label>
                        <input type="text" class="form-control" id="wifiPasswordInput2"
                            placeholder="Enter WiFi Password">
                    </div>

                    <!-- Enable Button -->
                    <button type="button" class="btn button  mt-3" onclick="enableHotspot('3')">Enable</button>
                    <button type="button" class="btn button  mt-3" onclick="enableHotspot('4')">Disable</button>
                </div>
                <div class="frame4 check" id="wifiSettings3">
                    <h3>WiFi 2A 5GHz</h3>

                    <!-- WiFi Name Input Field -->
                    <div class="mb-3">
                        <label for="wifiNameInput3" class="form-label">WiFi Name</label>
                        <input type="text" class="form-control" id="wifiNameInput3" placeholder="Enter WiFi Name">
                    </div>

                    <!-- WiFi Password Input Field -->
                    <div class="mb-3">
                        <label for="wifiPasswordInput3" class="form-label">WiFi Password</label>
                        <input type="text" class="form-control" id="wifiPasswordInput3"
                            placeholder="Enter WiFi Password">
                    </div>

                    <!-- Enable Button -->
                    <button type="button" class="btn button mt-3" onclick="enableHotspot('5')">Enable</button>
                    <button type="button" class="btn button  mt-3" onclick="enableHotspot('6')">Disable</button>
                </div>
                <!-- <form id="clear"> -->
                <div class="frame5 check" id="wifiSettings4">
                    <h3>WiFi 2B 2.4GHz</h3>

                    <!-- WiFi Name Input Field -->
                    <div class="mb-3">
                        <label for="wifiNameInput4" class="form-label">WiFi Name</label>
                        <input type="text" class="form-control" id="wifiNameInput4" placeholder="Enter WiFi Name">
                    </div>

                    <!-- WiFi Password Input Field -->
                    <div class="mb-3">
                        <label for="wifiPasswordInput4" class="form-label">WiFi Password</label>
                        <input type="text" class="form-control" id="wifiPasswordInput4"
                            placeholder="Enter WiFi Password">
                    </div>

                    <!-- Enable Button -->
                    <button type="button" class="btn  button mt-3" onclick="enableHotspot('7')">Enable</button>
                    <button type="button" class="btn button mt-3" onclick="enableHotspot('8')">Disable</button>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>

    <script>
        function loadWifiSettings(id) {
            const allLinks = document.querySelectorAll('.check');
            allLinks.forEach(link => link.classList.remove('Disable'));
            const elements = document.getElementsByClassName(id);
            if (elements.length > 0) {
                elements[0].classList.add("Disable");
            }
        }

        function enableNetwork() {
            // Get the selected WiFi radio button value
            const selectedNetwork = document.querySelector('input[name="network1"]:checked').value;

            // Get the SSID and password values
            const ssid = document.getElementById("ssidInput");
            const password = document.getElementById("passwordInput");
            // if ((password.length < 8)){
            //     alert("Password must be at least 8 characters long");
            //     ssid.value = '';
            //  password.value = '';
            //     return
            // }

            // Map the radio button value to the corresponding JSON keys
            let wifiKey;
            switch (selectedNetwork) {
                case 'WiFi 1A':
                    wifiKey = 5; // Write value 1 to key 5
                    break;
                case 'WiFi 1B':
                    wifiKey = 8; // Write value 1 to key 8
                    break;
                case 'WiFi 2A':
                    wifiKey = 11; // Write value 1 to key 11
                    break;
                case 'WiFi 2B':
                    wifiKey = 14; // Write value 1 to key 14
                    break;
                default:
                    wifiKey = 0;
            }

            // Create the data object to send to the server
            const data = {
                wifiKey: wifiKey,
                ssid: ssid.value,
                password: password.value
            };

            // Send a POST request to the server with the selected WiFi and credentials
            fetch('wifi_settings.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => response.text()) // Change to text() to see the raw response
                .then(result => {
                    console.log(result); // Log the result to check what is returned
                    try {
                        const json = JSON.parse(result); // Attempt to parse JSON
                        alert(json.message);
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            ssid.value = '';
            password.value= '';
        }
        function enableHotspot(id) {
                let wifiName, wifiPassword;

                if (id === '1') {
                    wifiName = document.getElementById('wifiNameInput1');
                    wifiPassword = document.getElementById('wifiPasswordInput1');
                } else if (id === '3') {
                    wifiName = document.getElementById('wifiNameInput2');
                    wifiPassword = document.getElementById('wifiPasswordInput2');
                } else if (id === '5') {
                    wifiName = document.getElementById('wifiNameInput3');
                    wifiPassword = document.getElementById('wifiPasswordInput3');
                } else if (id === '7') {
                    wifiName = document.getElementById('wifiNameInput4');
                    wifiPassword = document.getElementById('wifiPasswordInput4');
                }

                // Prepare data to send to PHP
                const data = {
                    wifiName: wifiName.value,
                    wifiPassword: wifiPassword.value,
                    action: "enable",
                    id: id
                };

                // Send data to PHP via fetch or XMLHttpRequest
                fetch('wifi_script.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(data => {
                        // Handle response from PHP
                        console.log('Success:', data);
                        document.getElementById("clear").reset();
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    }).finally(()=>{
                        wifiName.value=""
                        wifiPassword.value=""
                    });
            }
    </script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="assets/bootstrap.min.js"></script>
</body>

</html>