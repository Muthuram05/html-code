<?php
// script.php

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Check the action
if (in_array($data['action'], ['enable', 'disable'])) {
    $id = $data['id'];

    // Load current configuration
    $configFile = '/etc/configuration.json';
    $config = json_decode(file_get_contents($configFile), true);

    if ($data['action'] == 'enable') {
        $wifiName = $data['wifiName'];
        $wifiPassword = $data['wifiPassword'];

        // Update configuration based on ID
        if ($id == '1') {
            $config['6'] = $wifiName;
            $config['7'] = $wifiPassword;
        } else if ($id == '3') {
            $config['9'] = $wifiName;
            $config['10'] = $wifiPassword;
        } else if ($id == '5') {
            $config['12'] = $wifiName;
            $config['13'] = $wifiPassword;
        } else if ($id == '7') {
            $config['15'] = $wifiName;
            $config['16'] = $wifiPassword;
        }
    } elseif ($data['action'] == 'disable') {
        // Set values to null based on ID
        if ($id == '1') {
            $config['6'] = null;
            $config['7'] = null;
        } else if ($id == '3') {
            $config['9'] = null;
            $config['10'] = null;
        } else if ($id == '5') {
            $config['12'] = null;
            $config['13'] = null;
        } else if ($id == '7') {
            $config['15'] = null;
            $config['16'] = null;
        }
    }

    // Save updated configuration
    file_put_contents($configFile, json_encode($config, JSON_PRETTY_PRINT));

    // Respond back
    echo json_encode(['status' => 'success']);
} else {
    // Respond with error if action is not recognized
    echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
}

