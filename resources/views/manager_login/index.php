<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password (empty by default for XAMPP)
$database_name = "your_database"; // Replace with your database name

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $database_name);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $user_password = mysqli_real_escape_string($conn, $_POST['password']);

    // Complete the SQL query
    $sql = "SELECT * FROM manager WHERE user_name = '$user_name' AND password = '$user_password'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        // Start session and store user information if needed
        session_start();
        $_SESSION['loggedin'] = true; // Indicate that the user is logged in
        
        // Redirect to the management menu page
        header("Location: menu.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
} 

mysqli_close($conn);
?>
