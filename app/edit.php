<?php
require '../database/connect.php'; // Make sure to include the necessary connection setup

if (!isset($_GET['id'])) {
    header("Location: ../view/dashboard.php"); // Redirect if no task ID is provided
    exit();
}

$taskId = $_GET['id'];
$todo = $conn->prepare("SELECT * FROM todos WHERE id = ?");
$todo->execute([$taskId]);
$todoData = $todo->fetch(PDO::FETCH_ASSOC);

if (!$todoData) {
    header("Location: ../view/dashboard.php"); // Redirect if task ID doesn't exist
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the task details in the database
    // Assuming your form fields have the appropriate 'name' attributes
    $title = $_POST['title'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rollNo = $_POST['roll_no'];
    $address = $_POST['address'];

    $updateStmt = $conn->prepare("UPDATE todos SET title = ?, name = ?, email = ?, roll_no = ?, address = ? WHERE id = ?");
    $updateStmt->execute([$title, $name, $email, $rollNo, $address, $taskId]);

    header("Location: dashboard.php"); // Redirect back to dashboard after editing
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="../css/style.css">

    <style>
        form {
            text-align: center;

        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="edit-form-container">
        <h1>Edit Task</h1>
        <form action="" method="POST">
            <label for="title">Task Title</label>
            <input type="text" name="title" value="<?php echo $todoData['title']; ?>" required> <br><br>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $todoData['name']; ?>" required><br><br>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $todoData['email']; ?>" required><br><br>
            <label for="roll_no">Roll No</label>
            <input type="text" name="roll_no" value="<?php echo $todoData['roll_no']; ?>" required><br><br>
            <label for="address">Address</label>
            <input type="text" name="address" value="<?php echo $todoData['address']; ?>" required><br><br>

            <button type="submit">Update Task</button>
            <a href="../view/dashboard.php">Dashboard</a>
        </form>
    </div>

</body>

</html>