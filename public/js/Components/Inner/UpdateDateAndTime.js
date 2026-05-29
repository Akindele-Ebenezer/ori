
// Update date and time in real-time
function updateDateTime() {
    const now = new Date();
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit', 
        minute: '2-digit',
        second: '2-digit',
        hour12: true 
    };
    const formattedDate = now.toLocaleDateString('en-US', options);
    document.getElementById('currentDateTime').textContent = formattedDate;
}

// Update time immediately and then every second
updateDateTime();
setInterval(updateDateTime, 1000);

// Simulate system status updates
function updateSystemStatus() {
    const statusIndicators = document.querySelectorAll('#realTimeStatusBar [style*="background: #00b894"]');
    statusIndicators.forEach(indicator => {
        // Random slight color variation to simulate activity
        const variation = Math.random() * 20 - 10;
        const hue = 160 + variation; // Base green hue
        indicator.style.background = `hsl(${hue}, 70%, 50%)`;
    });
}

// Update status every 2 seconds
setInterval(updateSystemStatus, 2000);

// Add scroll effect - slight transparency when scrolling
let lastScrollTop = 0;
window.addEventListener('scroll', function() {
    const statusBar = document.getElementById('realTimeStatusBar');
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    if (scrollTop > lastScrollTop && scrollTop > 100) {
        // Scrolling down - make slightly transparent
        statusBar.style.opacity = '0.95';
    } else {
        // Scrolling up - make fully opaque
        statusBar.style.opacity = '1';
    }
    lastScrollTop = scrollTop;
});

// Simulate data updates (you can replace this with real API calls)
function simulateDataUpdate() {
    const progressBar = document.getElementById('updateProgressBar');
    progressBar.style.animation = 'none';
    setTimeout(() => {
        progressBar.style.animation = 'progressAnimation 30s linear infinite';
    }, 10);
}

// Simulate updates every 30 seconds
setInterval(simulateDataUpdate, 30000);