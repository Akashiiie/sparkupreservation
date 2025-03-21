<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link rel="stylesheet" href="admineventmaangementsstyles.css">
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
            <li class="active"><a href="#">Event Management</a></li>
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
        
        <section class="event-container">
            <h2>Manage Events</h2>
            <button class="create-event-btn" onclick="openModal()">Create Event</button>
            
            <div id="eventModal" class="modal">
                <div class="modal-content">
                    <span class="close-modal" onclick="closeModal()">&times;</span>
                    <h2>Create Event</h2>
                    <form id="eventForm" action="addevent.php" method="POST" enctype="multipart/form-data">
                        <label>Title</label>
                        <input type="text" name="title" placeholder="Add Title" required>
                        
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" placeholder="Enter Subtitle" required>
                        
                        <label>Date</label>
                        <input type="date" name="event_date" required>
                        
                        <label>Department</label>
                        <input type="text" name="department" placeholder="Enter Course Department" required>
                        
                        <label>Program</label>
                        <input type="text" name="program" placeholder="Add Program" required>
                        
                        <label>Description</label>
                        <textarea name="description" placeholder="Add Description" required></textarea>
                        
                        <label>Event Poster</label>
                        <input type="file" name="event_poster" required>
                        
                        <button type="submit" class="submit-event-btn">Submit Event</button>
                    </form>
                </div>
            </div>
        </section>

        <section class="event-list-container">
            <h2>Manage Events Details</h2>
            <table class="event-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Department</th>
                        <th>Program</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'dbconnect.php';
                    $query = "SELECT * FROM events";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['title']}</td>
                            <td>{$row['subtitle']}</td>
                            <td>{$row['department']}</td>
                            <td>{$row['program']}</td>
                            <td>{$row['event_date']}</td>
                            <td>{$row['description']}</td>
                            <td>
                                <button class='edit-btn'>Edit</button>
                                <button class='delete-btn'>Delete</button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script>
        function openModal() {
            document.getElementById("eventModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("eventModal").style.display = "none";
        }
    </script>
</body>
</html>
