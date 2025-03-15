<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admindashboardstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <h2>SPARKUP</h2>
        <img src="profile.png" alt="Admin Profile" class="profile-img">
        <p class="admin-name">Admin Name</p>
        <p class="admin-email">admin@example.com</p>
        <ul>
            <li class="active"><a href="#">Dashboard</a></li>
            <li><a href="adminreservations.html">Reservations</a></li>
            <li><a href="admineventmanagements.html">Event Management</a></li>
            <li><a href="adminfeedbacks.html">Feedbacks</a></li>
            <li><a href="adminusermanagements.html">User Management</a></li>
            <li><a href="adminprofilemanagement.html">Profile Management</a></li>
        </ul>
        <div class="footer">
            <img src="cite_logo.png" alt="CITE Logo" class="cite-logo">
            <p class="cite-email">Contact: <a href="mailto:cite-sc@up.phinma.edu.ph">cite-sc@up.phinma.edu.ph</a></p>
        </div>
    </div>
    
    <div class="main-content">
        <header>
            <div class="header-right">
                <div class="dropdown">
                    <button class="notif-btn">🔔 Notifications</button>
                    <div class="dropdown-content">
                        <p>📢 New reservation request received</p>
                        <p>📌 Event "Tech Summit 2024" updated</p>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="logout-btn">🚪 Log Out</button>
                    <div class="dropdown-content">
                        <p><a href="logout.php">Confirm Logout</a></p>
                    </div>
                </div>
            </div>
        </header>
        
        <section class="dashboard-container">
            <h2>Admin Dashboard</h2>
            <div class="dashboard-box">
                <div class="section upcoming-events">
                    <h3>Upcoming Events</h3>
                    <p>Check the latest events happening soon.</p>
                </div>
                <div class="section pending-events">
                    <h3>Pending Approvals</h3>
                    <p>Manage event and reservation approvals.</p>
                </div>
                <div class="section event-summary">
                    <h3>Event Summary</h3>
                    <p>View recent event statistics.</p>
                </div>
                <div class="section notifications">
                    <h3>Latest Notifications</h3>
                    <p>Stay updated with system alerts.</p>
                </div>
            </div>
            
            <!-- Feedback Chart Section -->
            <div class="chart-container">
                <h3>User Satisfaction Feedback</h3>
                <canvas id="feedbackChart"></canvas>
            </div>
        </section>
    </div>

    <script>
        const ctx = document.getElementById('feedbackChart').getContext('2d');
        const feedbackChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Excellent', 'Good', 'Average', 'Poor', 'Terrible'],
                datasets: [{
                    label: 'User Feedback Satisfaction',
                    data: [40, 30, 15, 10, 5], // Placeholder values
                    backgroundColor: ['#2b8a3e', '#87a96b', '#f4a000', '#d9534f', '#6c757d']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                }
            }
        });
    </script>
</body>
</html>
