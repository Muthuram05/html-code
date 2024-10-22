// Check login status on page load
window.onload = function () {
    if (localStorage.getItem("loggedIn") !== "true") {
        window.location.href = "login.php"; // Redirect to login if not logged in
    }
};
 
// Function to toggle the visibility of the network dropdown
function toggleNetworkDropdown(event) {
    event.preventDefault(); // Prevent default link behavior
    const dropdown = document.getElementById('network-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block'; // Toggle visibility
}
 
// Hide dropdown if clicking outside of it
document.addEventListener('click', function (event) {
    const dropdown = document.getElementById('network-dropdown');
    const networkLink = document.querySelector('.dropdown-toggle');
 
    // Check if click is outside the dropdown and the link
    if (!networkLink.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none'; // Hide dropdown if clicking outside
    }
});
 
document.addEventListener("DOMContentLoaded", function () {
    
    const contentArea = document.getElementById('content-area');
    const dropdownMenu = document.getElementById('network-dropdown');
    const loginForm = document.getElementById("loginForm");
    const errorDiv = document.getElementById("error");
 
    // Check login status on every page
    const isloggedIn=localStorage.getItem("loggedIn") 
     if (!isloggedIn) {
         window.location.href = "login.php"; // Redirect to login if not logged in
     }
 
    // Handle login form submission
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission
 
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
 
            // Validate credentials
            if (username === "Stryker" && password === "mAIstroStream") {
                localStorage.setItem("loggedIn", "true"); // Store login state in localStorage
                window.location.href = "index.php"; // Redirect to index1.html
            } else {
                errorDiv.textContent = "Invalid username or password."; // Display error
                errorDiv.style.display = "block"; // Show the error message
            }
        });
    }


   
 
    // Function to remove the 'active' class from all sidebar links
    function removeClass(selectedContent) {
        document.querySelectorAll('.section-left a').forEach(link => {
            if (link.getAttribute('data-content') !== selectedContent) {
                link.classList.remove("active");
            }
        });
    }
 
    // Handle dropdown visibility toggle
    const networkLink = document.querySelector('.dropdown-toggle');
    networkLink.addEventListener('click', toggleNetworkDropdown);
});
$(document).ready(function() {
    setInterval(function() {
        updateEth0();
    }, 1000); // Update every 1 seconds
});

function updateEth0() {
    $.ajax({
        url: 'eth0.php',
        type: 'GET',
        success: function(newContent) {
            $('#eth0').html(newContent);
            console.log(newContent);
        }
    });
}
function calculateSpeed() {
    const imageSizeInBytes = 1000000; // Size of the image (1 MB)
    const imageUrl = 'https://www.gstatic.com/webp/gallery/1.jpg'; // Replace with a suitable file URL

    const startTime = Date.now();

    // Create a new Image object
    const img = new Image();
    img.src = imageUrl + '?rand=' + Math.random(); // Append random query to avoid caching

    img.onload = function() {
        const endTime = Date.now();
        const durationInSeconds = (endTime - startTime) / 1000; // Convert ms to seconds
        const speedInMbps = (imageSizeInBytes * 8) / (durationInSeconds * 1000000); // Convert to Mbps
        document.getElementById('speed').innerText = `${speedInMbps.toFixed(2)} Mbps`;
    };

    img.onerror = function() {
        document.getElementById('speed').innerText = 'Error loading the image.';
    };

    // Timeout for loading
    setTimeout(function() {
        if (!img.complete) {
            document.getElementById('speed').innerText = 'Loading timed out.';
        }
    }, 5000); // 5 seconds timeout
}

// Start speed test on window load
window.onload = calculateSpeed;
// window.onload = updateDynamicWifiBandwidth;

function updateDynamicWifiBandwidth() {
    if ('connection' in navigator) {
        const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
        const downlink = connection.downlink; // Bandwidth in Mbps

        document.getElementById('bandwidth').innerText = downlink || 'Unknown';
        console.log(`Dynamic Wi-Fi Bandwidth: ${downlink} Mbps`);

        // Optional: You can also monitor changes in the connection
        connection.addEventListener('change', () => {
            const updatedDownlink = connection.downlink;
            document.getElementById('bandwidth').innerText = updatedDownlink || 'Unknown';
            console.log(`Updated Wi-Fi Bandwidth: ${updatedDownlink} Mbps`);
        });
    } else {
        document.getElementById('bandwidth').innerText = 'Not supported';
        console.log("Network Information API is not supported in this browser.");
    }
}
