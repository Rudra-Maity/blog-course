<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "course_platform");

$query = "SELECT id, name, description, price, discount_percentage FROM courses";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Platform</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Discounted Courses</h1>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name'] ?></h5>
                            <p class="card-text"><?= $row['description'] ?></p>
                            <?php 
                            $discounted_price = $row['price'] * ((100 - $row['discount_percentage']) / 100);
                            ?>
                            <p class="text-danger">Discounted Price: $<?= number_format($discounted_price, 2) ?></p>
                            <a href="course_purchase.php?id=<?= $row['id'] ?>" class="btn btn-primary">Buy Now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
