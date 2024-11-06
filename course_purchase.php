<?php
$conn = new mysqli("localhost", "root", "", "course_platform");
$course_id = $_GET['id'];

$course = $conn->query("SELECT * FROM courses WHERE id = $course_id")->fetch_assoc();
$discounted_price = $course['price'] * ((100 - $course['discount_percentage']) / 100);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Purchase Course</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h1>Purchase <?= $course['name'] ?></h1>
    <p>Amount: $<?= number_format($discounted_price, 2) ?></p>
    <button id="pay-button">Pay Now</button>

    <script>
        document.getElementById('pay-button').onclick = function() {
            var options = {
                "key": "YOUR_RAZORPAY_KEY",
                "amount": <?= $discounted_price * 100 ?>,
                "currency": "INR",
                "name": "Course Platform",
                "description": "Purchase",
                "handler": function(response) {
                    alert('Payment Successful!');
                    window.location.href = "purchase_success.php";
                },
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        };
    </script>
</body>
</html>
