<?php
session_start();
include("db.php");

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission (Add Event)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    // File Upload Handling
    $target_dir = "uploads/"; // Folder to store images
    $image_name = basename($_FILES["event_image"]["name"]);
    $target_file = $target_dir . time() . "_" . $image_name; 
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image
    $check = getimagesize($_FILES["event_image"]["tmp_name"]);
    if ($check === false) {
        $error = "File is not an image.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Upload the file if no errors
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO events (title, description, event_date, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $description, $event_date, $target_file);

            if ($stmt->execute()) {
                header("Location: dashboard.php"); // Refresh page after adding event
                exit();
            } else {
                $error = "Error adding event.";
            }
        } else {
            $error = "Error uploading file.";
        }
    }
}

// Fetch events from the database
$result = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .dashboard {
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            text-align: center;
        }

        .event-form, .events-list {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .event-form input, .event-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .event-form button {
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .event-form button:hover {
            background: #218838;
        }

        /* Updated Event List Styling */
        .events-list {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .event-box {
            width: 250px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            text-align: center;
            display: flex;
            flex-direction: column;
        }

        .event-box img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .event-details {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            flex-grow: 1;
        }

        .event-details h3 {
            margin: 5px 0;
            font-size: 18px;
        }

        .event-details p {
            font-size: 14px;
        }

        /* Delete button */
        .delete-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: red;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 0 0 10px 10px;
            cursor: pointer;
            position: relative;
        }

        .delete-btn:hover {
            background: darkred;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h2>Welcome, Admin!</h2>
        <a href="logout.php">Logout</a>

        <div class="event-form">
            <h3>Add Event</h3>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Event Title" required>
                <textarea name="description" placeholder="Event Description" rows="4" required></textarea>
                <input type="text" id="event_date" name="event_date" placeholder="Select Date" readonly required>
                <input type="file" name="event_image" accept="image/*" required>
                <button type="submit">Add Event</button>
            </form>
        </div>

        <div class="events-list">
            <h3>My Events</h3>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($event = $result->fetch_assoc()): ?>
                    <div class="event-box">
                        <img src="<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image">
                        <div class="event-details">
                            <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                            <p><?php echo htmlspecialchars($event['event_date']); ?></p>
                        </div>
                        <a href="delete.php?id=<?php echo $event['id']; ?>" class="delete-btn" 
                           onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No events available.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#event_date", {
            dateFormat: "Y-m-d",
            minDate: "today"
        });
    </script>
</body>
</html>


