<?php
session_start();
session_unset();   // Clear all active user session parameters
session_destroy(); // Terminate the active session
header("Location: login.php"); // Send user back to secure portal entry
exit;
?>