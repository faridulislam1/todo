<?php
require '../database/connect.php'; // Make sure to include the necessary connection setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert a new task into the database
    // Assuming your form fields have the appropriate 'name' attributes
    $title = $_POST['title'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rollNo = $_POST['roll_no'];
    $address = $_POST['address'];

    $insertStmt = $conn->prepare("INSERT INTO todos (title, name, email, roll_no, address, date_time) VALUES (?, ?, ?, ?, ?, NOW())");
    $insertStmt->execute([$title, $name, $email, $rollNo, $address]);

    header("Location: dashboard.php"); // Redirect back to dashboard after adding
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Add your CSS link here -->
</head>

<body>
    <div class="add-form-container">
        <h1>Add Task</h1>
        <form action="" method="POST">
            <label for="title">Task Title</label>
            <input type="text" name="title" placeholder="What do you need to do?" required>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $todoData['name']; ?>" required>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $todoData['email']; ?>" required>
            <label for="roll_no">Roll No</label>
            <input type="number" name="roll_no" value="<?php echo $todoData['roll_no']; ?>" required>
            <label for="address">Address</label>
            <input type="text" name="address" value="<?php echo $todoData['address']; ?>" required>

            <button type="submit">Add Task</button>
        </form>
    </div>
</body>

</html>