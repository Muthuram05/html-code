<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Get the raw POST data
$data = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array
$networkConfig = json_decode($data, true);
// $configFile = 'figuration.json';
// Function to validate if an IP address is in a given range
function validateIPRange($ipAddress, $range) {
    list($subnet, $maskBits) = explode('/', $range);

    // Convert IP addresses to long integers for comparison
    $ipLong = ip2long($ipAddress);
    $subnetLong = ip2long($subnet);
    
    // Calculate mask
    $mask = -1 << (32 - $maskBits);

    // Calculate the range based on the subnet and mask
    $rangeStart = $subnetLong & $mask;
    $rangeEnd = $rangeStart + (~$mask);

    // Check if the IP falls within the range
    return ($ipLong >= $rangeStart && $ipLong <= $rangeEnd);
}

// Validate if all the necessary fields are present
if (isset(
        $networkConfig['ipAddressB1'], 
        $networkConfig['portB1'], 
        $networkConfig['ipAddressB2'], 
        $networkConfig['portB2'],
        $networkConfig['21'],  // Loopout for Board 1
        $networkConfig['24'],   // Loopout for Board 2
        $networkConfig['26'],  // WiFi value for Board 1
        $networkConfig['27']   // WiFi value for Board 2
    )) {

    // Validate IP address format
    if (
        filter_var($networkConfig['ipAddressB1'], FILTER_VALIDATE_IP) === false ||
        filter_var($networkConfig['ipAddressB2'], FILTER_VALIDATE_IP) === false
    ) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid IP address format.']);
        exit;
    }

    // Validate IP address range (e.g., for private network 192.168.0.0/16)
    if (
        !validateIPRange($networkConfig['ipAddressB1'], '192.168.0.0/16') || 
        !validateIPRange($networkConfig['ipAddressB2'], '192.168.0.0/16')
    ) {
        echo json_encode(['status' => 'error', 'message' => 'IP address out of allowed range.']);
        exit;
    }

    // Validate port numbers
    if (
        !is_numeric($networkConfig['portB1']) || !is_numeric($networkConfig['portB2']) ||
        $networkConfig['portB1'] < 1 || $networkConfig['portB1'] > 65535 ||
        $networkConfig['portB2'] < 1 || $networkConfig['portB2'] > 65535
    ) {
        echo json_encode(['status' => 'error', 'message' => 'Ports must be between 1 and 65535.']);
        exit;
    }

    // Define the path to your JSON file
    $configFilePath = '/etc/configuration.json';  // Update this path as per your setup

    // Load the existing JSON file
    if (file_exists($configFilePath)) {
        $currentConfig = json_decode(file_get_contents($configFilePath), true);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Configuration file not found.']);
        exit;
    }

    // Update the specific values in the JSON structure
    $currentConfig['19'] = $networkConfig['ipAddressB1']; // Save IP address B1 to key '19'
    $currentConfig['20'] = $networkConfig['portB1'];      // Save port B1 to key '20'
    $currentConfig['22'] = $networkConfig['ipAddressB2']; // Save IP address B2 to key '22'
    $currentConfig['23'] = $networkConfig['portB2'];      // Save port B2 to key '23'
    $currentConfig['21'] = $networkConfig['21'];           // Save loopout value for Board 1
    $currentConfig['24'] = $networkConfig['24'];           // Save loopout value for Board 2
    $currentConfig['26'] = $networkConfig['26'];           // Save WiFi value for Board 1
    $currentConfig['27'] = $networkConfig['27']; 

    // Write the updated configuration back to the JSON file
    if (file_put_contents($configFilePath, json_encode($currentConfig, JSON_PRETTY_PRINT))) {
        // If successful, send a success response
        echo json_encode(['status' => 'success', 'message' => 'Configuration saved successfully.']);
    } else {
        // If there's an error writing to the file, send an error response
        echo json_encode(['status' => 'error', 'message' => 'Could not write to configuration file.']);
    }
} else {
    // If the necessary fields are not present, send an error response
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
}

