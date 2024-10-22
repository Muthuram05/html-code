<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the path to the configuration file
$configFile = '/etc/configuration.json'; // Update the path as needed

// Function to read the configuration file
function readConfig($file)
{
    if (!file_exists($file)) {
        http_response_code(404);
        echo json_encode(['message' => 'Configuration file not found.']);
        exit;
    }
    $json = file_get_contents($file);
    if ($json === false) {
        http_response_code(500);
        echo json_encode(['message' => 'Error reading configuration file.']);
        exit;
    }
    return json_decode($json, true);
}

// Function to write to the configuration file
function writeConfig($file, $data)
{
    if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT)) === false) {
        http_response_code(500);
        echo json_encode(['message' => 'Error writing to configuration file.']);
        exit;
    }
}

// Handle GET request to fetch current settings
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $config = readConfig($configFile);
    echo json_encode($config);
    exit;
}

// Handle POST request to enable network
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Validate input data
    if (isset($inputData['wifiKey'], $inputData['ssid'], $inputData['password'])) {
        $config = readConfig($configFile);

        foreach (['5', '8', '11', '14'] as $key) {
            $config[$key] = "";
        }

        $config[$inputData['wifiKey']] = 1;
        $config['3'] = $inputData['ssid'];
        $config['4'] = $inputData['password'];

        writeConfig($configFile, $config);

        http_response_code(200);
        echo json_encode(['message' => 'Configuration updated successfully!']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid input: WiFi key, SSID, and Password are required.']);
    }
    exit;
}

