<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback Management</title>
    <link rel="stylesheet" href="adminfeedbackstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <h2>SPARKUP</h2>
        <img src="profile.png" alt="Admin Profile" class="profile-img">
        <p class="admin-name">Admin Name</p>
        <p class="admin-email">admin@example.com</p>
        <ul>
            <li><a href="admindashboard.html">Dashboard</a></li>
            <li><a href="adminreservations.html">Reservations</a></li>
            <li><a href="admineventmanagements.html">Event Management</a></li>
            <li class="active"><a href="#">Feedbacks</a></li>
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
                </div>
                <div class="dropdown">
                    <button class="logout-btn">🚪 Log Out</button>
                </div>
            </div>
        </header>
        
        <section class="feedback-container">
            <h2>Admin Feedback Management</h2>
            <div class="feedback-summary">
                <h3>Total Feedbacks: <span id="total-feedbacks">0</span></h3>
                <h3>Average Rating: <span id="average-rating">0</span></h3>
            </div>
            <canvas id="feedbackChart"></canvas>
            
            <h3>User Feedbacks</h3>
            <table class="feedback-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Feedback</th>
                        <th>Rating</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'dbconnect.php';
                    $query = "SELECT * FROM feedbacks";
                    $result = mysqli_query($conn, $query);
                    $feedbacks = [];
                    $totalRatings = 0;
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['user_name']}</td>
                            <td>{$row['feedback']}</td>
                            <td>{$row['rating']}</td>
                            <td>{$row['date_submitted']}</td>
                        </tr>";
                        $feedbacks[] = $row['rating'];
                        $totalRatings += $row['rating'];
                        $count++;
                    }
                    $averageRating = $count > 0 ? round($totalRatings / $count, 1) : 0;
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script>
        document.getElementById("total-feedbacks").innerText = "<?php echo $count; ?>";
        document.getElementById("average-rating").innerText = "<?php echo $averageRating; ?>";
        
        const ctx = document.getElementById('feedbackChart').getContext('2d');
        const feedbackChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Excellent', 'Good', 'Average', 'Poor', 'Terrible'],
                datasets: [{
                    label: 'User Feedback Satisfaction',
                    data: [<?php echo implode(',', array_count_values($feedbacks)); ?>], // Dynamic feedback counts
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
