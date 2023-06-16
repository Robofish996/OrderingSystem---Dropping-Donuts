
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/purchase.css">
    <title>Thank you for your purchase</title>
</head>
<body>
<div class="container">
<?php
// Check if the purchase order number is present
if (isset($_POST['purchaseOrderNumber'])) {
    // Retrieve the purchase order number
    $purchaseOrderNumber = $_POST['purchaseOrderNumber'];

    // Process the payment
    $paymentSuccessful = simulatePayment();

    if ($paymentSuccessful) {
        // After the payment is processed successfully, display a success message
        echo "<h2>Payment Successful!</h2>";
        echo "<p>Thank you for your order. Your payment has been processed.</p>";
        echo "<p>Purchase Order Number: $purchaseOrderNumber</p>";
        echo "<p>Redirecting to home page...</p>";

        // Redirect the user to the home page after a delay
       header("refresh:10; url=home.php");
        exit();
    } else {
        // Payment failed, display an error message
        echo "<h2>Payment Failed!</h2>";
        echo "<p>We apologize, but there was an issue processing your payment. Please try again later.</p>";
    }
} else {
    // Redirect the user back to the home page if the necessary data is not present
    header("Location: index.php");
    exit();
}

// Function to simulate the payment
function simulatePayment()
{

    return true;
}
?>
</div>
</body>
</html>
