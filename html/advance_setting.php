<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stryker</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <script src="assets/jquery-3.7.1.min.js"></script>
    <style>
        .container {
            background-color: #ddab41;
            padding: 20px;
            border-radius: 5px;
            max-width: 500px;

            margin: auto;
        }

        body {
            background-color: #fff6f7;
        }

        label {
            color: black;
            font-weight: bold;
        }

        .button {
            background-color: whitesmoke;
        }

        .button:hover {
            background-color: #deac4f;
            /* Background color on hover */
            color: black;
            /* Text color on hover */
        }

        .form-control {
            color: black;
            font-weight: bold;
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
            <a href="#" class="text-decoration-none py-4 px-3 text-white dropdown-toggle active">Network</a>
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
        <div class="container mt-5">
            <h2>Advanced Settings</h2>
            <form id="advancedSettingsForm" method="POST">
                <div class="form-group">
                    <label for="encoder">Encoder:</label>
                    <select class="form-control" id="encoder" name="encoder">
                        <option value="h264">H264</option>
                        <option value="h265">H265</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="profile">Profile:</label>
                    <select class="form-control" id="profile" name="profile">

                    </select>
                </div>

                <div class="form-group">
                    <label for="controlRate">Control Rate:</label>
                    <select class="form-control" id="controlRate" name="controlRate">
                        <option value="low-latency">Low Latency</option>
                        <option value="variable">Variable</option>
                        <option value="constant">Constant</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="rescaleOutput">HDMI loopout1</label>
                    <select class="form-control" id="rescaleOutput" name="rescaleOutput">
                        <option value="1280x720p">1280x720p</option>
                        <option value="1920x1080p">1920x1080p</option>
                        <option value="3840x1260p">3840x1260p</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="rescaleOutput">HDMI loopout2</label>
                    <select class="form-control" id="rescaleOutput" name="rescaleOutput">
                        <option value="1280x720p">1280x720p</option>
                        <option value="1920x1080p">1920x1080p</option>
                        <option value="3840x1260p">3840x1260p</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="bitrate">Bitrate:</label>
                    <input type="number" class="form-control" id="bitrate" min="1000" max="6000" name="bitrate"
                        placeholder="Enter bitrate" required>
                </div>
                <div><button type="submit" class="btn mt-3 button">Enable</button>
                    <button type="submit" class="btn mt-3 button">Disable</button>
                </div>

            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get the posted values
                $encoder = $_POST['encoder'];
                $profile = $_POST['profile'];
                $controlRate = $_POST['controlRate'];
                $bitrate = $_POST['bitrate'];
                $rescaleOutput = $_POST['rescaleOutput'];

                // Specify the path to the configuration file
                $configFile = '/etc/configuration.json';

                // Load the existing configuration
                if (file_exists($configFile)) {
                    $configData = json_decode(file_get_contents($configFile), true);
                } else {
                    // Handle the case where the file does not exist
                    $configData = [];
                }

                // Update the configuration with the submitted values
            
                $configData["29"] = $profile;
                $configData["30"] = $controlRate;
                $configData["31"] = $bitrate;
                $configData["32"] = $encoder;
                $configData["33"] = $rescaleOutput;

                // Save the updated configuration back to the JSON file
                if (file_put_contents($configFile, json_encode($configData, JSON_PRETTY_PRINT)) === false) {
                    echo "<div class='alert alert-danger mt-3'>Failed to save configuration.</div>";
                } else {
                    echo "<div class='alert alert-success mt-3'>Configuration saved successfully!</div>";
                }
            }
            ?>
        </div>
        <script>
            $(document).ready(function () {
                $('#encoder').change(function () {
                    var selectedEncoder = $(this).val();
                    var profileSelect = $('#profile');

                    // Clear existing options
                    profileSelect.empty();

                    if (selectedEncoder === 'h264') {
                        // Add only 'High' option for H264
                        profileSelect.append('<option value="main">Main</option>');
                    } else {
                        // Add all options for H265
                        profileSelect.append('<option value="baseline">Baseline</option>');
                        profileSelect.append('<option value="main">Main</option>');
                        profileSelect.append('<option value="high">High</option>');
                    }
                });

                // Trigger change event to initialize options based on default selection
                $('#encoder').change();
            });
        </script>
        <script src="script.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="assets/bootstrap.min.js"></script>
    </div>
</body>

</html>