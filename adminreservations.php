<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="adminreservationstyles.css">
</head>
<body>
    <div class="sidebar">
        <h2>SPARKUP</h2>
        <img src="profile.png" alt="Admin Profile" class="profile-img">
        <p class="admin-name">Admin Name</p>
        <p class="admin-email">admin@example.com</p>
        <ul>
            <li><a href="admindashboard.html">Dashboard</a></li>
            <li class="active"><a href="#">Reservations</a></li>
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
                </div>
                <div class="dropdown">
                    <button class="logout-btn">🚪 Log Out</button>
                </div>
            </div>
        </header>

        <section class="reservations-container">
            <h2>Reservations</h2>
            <h3>Select an Event to Reserve</h3>
            <form action="reserve_event.php" method="POST">
                <label for="event">Choose Event:</label>
                <select name="event_id" required>
                    <?php
                    include 'dbconnect.php';
                    $query = "SELECT * FROM events";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['event_id']}'>{$row['title']} - {$row['event_date']}</option>";
                    }
                    ?>
                </select>
                <button type="submit">Reserve</button>
            </form>

            <h3>Reserved Students For Events</h3>
            <table>
                <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Student Name</th>
                        <th>Student Number</th>
                        <th>Status</th>
                        <th>Reserved Seats</th>
                        <th>Program</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM reservations";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['reservation_id']}</td>
                            <td>{$row['student_name']}</td>
                            <td>{$row['student_number']}</td>
                            <td class='{$row['status']}'>{$row['status']}</td>
                            <td>{$row['reserved_seats']}</td>
                            <td>{$row['program']}</td>
                            <td>{$row['reservation_date']}</td>
                            <td>
                                <button class='status-btn' onclick='openStatusModal(this, {$row['reservation_id']})'>Change Status</button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script>
        let selectedReservationId;
        function openStatusModal(button, reservationId) {
            selectedReservationId = reservationId;
            document.getElementById("statusModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("statusModal").style.display = "none";
        }
    </script>
</body>
</html>
