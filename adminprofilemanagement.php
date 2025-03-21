<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile Management</title>
    <link rel="stylesheet" href="adminprofilemanagementstyles.css">
</head>
<body>
    <div class="sidebar">
        <h2>SPARKUP</h2>
        <img src="profile.png" alt="Admin Profile" class="profile-img">
        <p class="admin-name" id="admin-name">Loading...</p>
        <p class="admin-email" id="admin-email">Loading...</p>
        <ul>
            <li><a href="admindashboard.html">Dashboard</a></li>
            <li><a href="adminreservations.html">Reservations</a></li>
            <li><a href="admineventmanagements.html">Event Management</a></li>
            <li><a href="adminfeedbacks.html">Feedbacks</a></li>
            <li><a href="adminusermanagements.html">User Management</a></li>
            <li class="active"><a href="#">Profile Management</a></li>
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

        <section class="profile-container">
            <h2>Admin Profile</h2>
            <div class="profile-card">
                <img src="profile.png" alt="Admin Profile" class="profile-pic">
                <p><strong>Admin Profile Picture</strong></p>
                <button class="change-pic-btn">Change Profile IMG</button>
            </div>
            
            <div class="profile-details">
                <p><strong>Admin Name:</strong> <span id="admin-display-name">Loading...</span></p>
                <p><strong>Admin Email:</strong> <span id="admin-display-email">Loading...</span></p>
                <button class="update-btn" onclick="openEditModal()">Change Information</button>
            </div>
        </section>
    </div>

    <!-- Profile Edit Modal -->
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeEditModal()">&times;</span>
            <h2>Edit Profile</h2>
            <form id="editProfileForm" action="update_profile.php" method="POST">
                <label>Admin Name</label>
                <input type="text" id="edit-admin-name" name="admin_name" placeholder="Enter New Name">
                
                <label>Admin Email</label>
                <input type="email" id="edit-admin-email" name="admin_email" placeholder="Enter New Email">
                
                <label>New Password</label>
                <input type="password" id="edit-admin-password" name="admin_password" placeholder="Enter New Password">
                
                <label>Confirm Password</label>
                <input type="password" id="confirm-admin-password" placeholder="Confirm Password">
                
                <button type="submit" class="save-changes-btn">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        function openEditModal() {
            document.getElementById("editProfileModal").classList.add("show");
        }

        function closeEditModal() {
            document.getElementById("editProfileModal").classList.remove("show");
        }

        // Fetch Admin Profile Data from Backend
        function fetchAdminProfile() {
            fetch("fetch_admin_profile.php")
                .then(response => response.json())
                .then(data => {
                    document.getElementById("admin-display-name").innerText = data.name;
                    document.getElementById("admin-display-email").innerText = data.email;
                    document.getElementById("edit-admin-name").value = data.name;
                    document.getElementById("edit-admin-email").value = data.email;
                })
                .catch(error => console.error("Error fetching admin profile:", error));
        }

        fetchAdminProfile();
    </script>
</body>
</html>
