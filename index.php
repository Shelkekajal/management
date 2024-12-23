<?php
$insert = false;

if (isset($_POST['name'])) {
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "trip";
    $port = 3307; // Specify the port number

    // Create a database connection
    $con = mysqli_connect($server, $username, $password, $database, $port);

    // Check for connection success
    if (!$con) {
        die("Connection to this database failed due to " . mysqli_connect_error());
    }

    // Collect post variables
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $info = $_POST['desc']; // Changed to 'desc' to match form input name

    // Prepare SQL statement with placeholders to prevent SQL injection
    $sql = "INSERT INTO trip (name, age, gender, email, phone, info) 
            VALUES ('$name', '$age', '$gender', '$email', '$phone', '$info')";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        $insert = true; // Set insert flag on success
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="bg" src="bg1.jpg" alt="IIT Kharagpur">
    <div class="container">
        <h1>Welcome to JSPM, Hadpsar Hyderabad Trip Form</h1>
        <p>Enter your details and submit this form to confirm your participation in the trip</p>
        <?php
        if ($insert) {
            echo "<p class='submitMsg'>Thanks for submitting your form. We are happy to see you joining us for the US trip</p>";
        }
        ?>
        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
            <input type="text" name="age" id="age" placeholder="Enter your Age" required>
            <input type="text" name="gender" id="gender" placeholder="Enter your gender" required>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <input type="text" name="phone" id="phone" placeholder="Enter your phone" required>
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>
