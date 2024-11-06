<?php
$conn = new mysqli("localhost", "root", "", "course_platform");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $scheduled_time = $_POST['scheduled_time'];

    $stmt = $conn->prepare("INSERT INTO blogs (title, content, scheduled_time) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $scheduled_time);
    $stmt->execute();     
}

$blogs = $conn->query("SELECT * FROM blogs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Create a Blog Post</h1>
        <form method="POST" action="admin_blog.php">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Schedule Time</label>
                <input type="datetime-local" name="scheduled_time" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h2 class="mt-4">Blog List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Scheduled Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $blogs->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['scheduled_time'] ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
