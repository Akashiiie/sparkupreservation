<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="adminusermanagementsstyles.css">
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
            <li><a href="adminfeedbacks.html">Feedbacks</a></li>
            <li class="active"><a href="#">User Management</a></li>
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

        <section class="user-management-container">
            <h2>Manage Users</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Student Number</th>
                        <th>Program</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'dbconnect.php';
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['student_number']}</td>
                            <td>{$row['program']}</td>
                            <td>{$row['department']}</td>
                            <td>
                                <button class='edit-btn' onclick='openEditModal({$row['id']}, "{$row['name']}", "{$row['email']}", "{$row['student_number']}", "{$row['program']}", "{$row['department']}")'>Edit</button>
                                <button class='delete-btn' onclick='deleteUser({$row['id']})'>Delete</button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <!-- User Edit Modal -->
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeEditModal()">&times;</span>
            <h2>Edit User</h2>
            <form id="editUserForm" action="updateuser.php" method="POST">
                <input type="hidden" id="editUserId" name="user_id">
                
                <label>Name</label>
                <input type="text" id="editName" name="name" required>
                
                <label>Email</label>
                <input type="email" id="editEmail" name="email" required>
                
                <label>Student Number</label>
                <input type="text" id="editStudentNumber" name="student_number" required>
                
                <label>Program</label>
                <input type="text" id="editProgram" name="program" required>
                
                <label>Department</label>
                <input type="text" id="editDepartment" name="department" required>
                
                <button type="submit" class="save-changes-btn">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(userId, name, email, studentNumber, program, department) {
            document.getElementById("editUserModal").style.display = "flex";
            document.getElementById("editUserId").value = userId;
            document.getElementById("editName").value = name;
            document.getElementById("editEmail").value = email;
            document.getElementById("editStudentNumber").value = studentNumber;
            document.getElementById("editProgram").value = program;
            document.getElementById("editDepartment").value = department;
        }

        function closeEditModal() {
            document.getElementById("editUserModal").style.display = "none";
        }

        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                fetch('deleteuser.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'id=' + userId
                })
                .then(response => response.text())
                .then(data => {
                    if (data === "success") {
                        alert("User deleted successfully.");
                        location.reload();
                    } else {
                        alert("Failed to delete user.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        }
    </script>
</body>
</html>
