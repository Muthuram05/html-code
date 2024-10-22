<?php

function IPAddressvalidation($ipAddress) {
    // Validate IPv4 and IPv6 addresses
    return filter_var($ipAddress, FILTER_VALIDATE_IP) !== false;
}

function getEth0Status() {
    $filePath = '/sys/class/net/eno1/operstate';

    // Check if the file exists
    if (file_exists($filePath)) {
        // Read the content of the file
        $content = file_get_contents($filePath);

        // Trim any leading or trailing whitespace
        $status = trim($content);

        // Check the status
        if ($status === 'up') {
            // Get the IP address of eth0
            $eth0IP = trim(exec("/sbin/ifconfig eno1  | grep 'inet addr:' | cut -d: -f2 | awk '{print $1}'"));
            if (IPAddressvalidation($eth0IP)){
                return $eth0IP;
            }
            return 'Up';
        } elseif ($status === 'down') {
            return 'Down';
        } else {
            return 'Unknown status';
        }
    } else {
        return 'Unknown Status';
    }
}

// Get and display the status
$status = getEth0Status();
echo $status;

?>
