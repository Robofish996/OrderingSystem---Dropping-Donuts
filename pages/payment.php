<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/payment.css">
    <title>Dropping Donuts Payment</title>
</head>

<body>
    <div class="container">
        <?php
        // Check if all is selected from home.php
        if (
            isset($_GET['username']) &&
            isset($_GET['glaze']) &&
            isset($_GET['toppings']) &&
            isset($_GET['filling']) &&
            isset($_GET['quantity']) &&
            isset($_GET['subtotal'])
        ) {
            // Get the DATA from home.php
            $username = $_GET['username'];
            $glaze = $_GET['glaze'];
            $toppings = explode(",", $_GET['toppings']);
            $filling = $_GET['filling'];
            $quantity = $_GET['quantity'];
            $subtotal = $_GET['subtotal'];

            // Generate a purchase order number
            $purchaseOrderNumber = generatePurchaseOrderNumber();

            echo "<h1>Payment Details</h1>";
            echo "<p>Purchase Order Number: $purchaseOrderNumber</p>";
            echo "<p>Username: $username</p>";
            echo "<p>Glaze: $glaze</p>";
            echo "<p>Toppings: " . implode(", ", $toppings) . "</p>";
            echo "<p>Filling: $filling</p>";
            echo "<p>Quantity: $quantity</p>";
            echo "<p>Subtotal: R$subtotal</p>";

            // Add the Place Order button
            echo "<form action=\"purchase.php\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"purchaseOrderNumber\" value=\"$purchaseOrderNumber\">";
            echo "<input type=\"hidden\" name=\"subtotal\" value=\"$subtotal\">";
            echo "<input type=\"submit\" value=\"Place Order\">";
            echo "</form>";

            // Add the Add More Items button
            echo "<form action=\"home.php\">";
            echo "<input type=\"submit\" value=\"Add More Items\">";
            echo "</form>";
        } else {
            // Redirect the user back to the home page if the necessary data is not present
            header("Location: index.php");
            exit();
        }

        // Function to generate a unique purchase order number
        function generatePurchaseOrderNumber()
        {
            $timestamp = time();
            $randomNumber = mt_rand(100000, 999999);
            $purchaseOrderNumber = $timestamp . $randomNumber;

            return $purchaseOrderNumber;
        }
        ?>
    </div>
</body>

</html>
