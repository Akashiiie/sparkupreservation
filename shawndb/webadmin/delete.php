<?php
include 'db.php'; // Make sure you have a database connection

if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Get image path
    $stmt = $conn->prepare("SELECT image FROM events WHERE id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    // Delete image file if it exists
    if (!empty($image) && file_exists($image)) {
        unlink($image); // Delete the image file
    }

    // Delete event from database
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $event_id);
    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Redirect back to dashboard
        exit();
    } else {
        echo "Error deleting event.";
    }
}
?>
