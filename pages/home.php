<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the form inputs
    $username = $_SESSION['username'];
    $glaze = $_POST['glaze'];
    $toppings = $_POST['toppings'];
    $filling = $_POST['filling'];
    $quantity = $_POST['quantity'];

    // Perform validation on the inputs
    $errors = [];

    // Validate glaze
    if (empty($glaze)) {
        $errors[] = "Please select a glaze option.";
    }

    // Validate toppings
    if (count($toppings) > 3) {
        $errors[] = "You can select a maximum of 3 toppings.";
    }

    // Validate quantity
    if ($quantity < 1) {
        $errors[] = "Please enter a valid quantity.";
    }

    // If there are no errors, redirect to the payment page
    if (empty($errors)) {
        // Calculate the price of a single donut with add-ons
        $pricePerDonut = calcPriceOfDonut($glaze, $toppings, $filling);

        // Calculate the subtotal of the order
        $subtotal = getOrderTotal($pricePerDonut, $quantity);

        // Redirect to the payment page with the necessary data
        header("Location: payment.php?username=$username&glaze=$glaze&toppings=" . implode(",", $toppings) . "&filling=$filling&quantity=$quantity&subtotal=$subtotal");
        exit();
    }
}

// Function to calculate the price of a single donut with add-ons
function calcPriceOfDonut($glaze, $toppings, $filling)
{
    $basePrice = 10; // Price of a plain donut

    // Additional cost for glaze
    $glazeCost = ($glaze !== 'plain') ? 2 : 0;

    // Additional cost for toppings
    $toppingsCost = count($toppings) * 2;

    // Additional cost for filling
    $fillingCost = ($filling !== 'none') ? 2 : 0;

    // Calculate the total price with add-ons
    $totalPrice = $basePrice + $glazeCost + $toppingsCost + $fillingCost;

    return $totalPrice;
}

// Function to calculate the subtotal of the order
function getOrderTotal($pricePerDonut, $quantity)
{
    return $pricePerDonut * $quantity;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <title>Dropping Donuts Main</title>
</head>

<body>

    <h1>Welcome to Dropping Donuts</h1>
    <h2>Logged in as: <?php echo $_SESSION['username']; ?></h2>

    <a href="logout.php">Logout</a>

    <!-- Order form -->
    <h2>Place Your Order</h2>
    <?php if (!empty($errors)) { ?>
        <div class="error">
            <?php foreach ($errors as $error) { ?>
                <p><?php echo $error; ?></p>
            <?php } ?>
        </div>
    <?php } ?>
    <form action="" method="post">
        <!-- Glaze Options -->

        <h3>Glaze:</h3>

        <label for="glaze_plain"><input type="radio" name="glaze" id="glaze_plain" value="plain" checked>Plain</label><br>
        <label for="glaze_chocolate"><input type="radio" name="glaze" id="glaze_chocolate" value="chocolate">Chocolate</label><br>
        <label for="glaze_vanilla"><input type="radio" name="glaze" id="glaze_vanilla" value="vanilla">Vanilla</label><br>
        <label for="glaze_strawberry"><input type="radio" name="glaze" id="glaze_strawberry" value="strawberry">Strawberry</label><br>

        <!-- Topping Options -->

        <h3>Toppings (Select up to 3):</h3>
        <label for="toppings_sprinkles"><input type="checkbox" name="toppings[]" id="toppings_sprinkles" value="sprinkles">Sprinkles</label><br>
        <label for="toppings_chocolate_chips"><input type="checkbox" name="toppings[]" id="toppings_chocolate_chips" value="chocolate_chips">Chocolate Chips</label><br>
        <label for="toppings_coconut"><input type="checkbox" name="toppings[]" id="toppings_coconut" value="coconut">Coconut</label><br>
        <label for="toppings_nuts"><input type="checkbox" name="toppings[]" id="toppings_nuts" value="nuts">Nuts</label><br>
        <label for="toppings_caramel"><input type="checkbox" name="toppings[]" id="toppings_caramel" value="caramel">Caramel</label><br>
        <label for="toppings_oreo"><input type="checkbox" name="toppings[]" id="toppings_oreo" value="oreo">Oreo</label><br>
        <label for="toppings_rainbow_sprinkles"><input type="checkbox" name="toppings[]" id="toppings_rainbow_sprinkles" value="rainbow_sprinkles">Rainbow Sprinkles</label><br>
        <label for="toppings_gummy_bears"><input type="checkbox" name="toppings[]" id="toppings_gummy_bears" value="gummy_bears">Gummy Bears</label><br>
        <label for="toppings_marshmallows"><input type="checkbox" name="toppings[]" id="toppings_marshmallows" value="marshmallows">Marshmallows</label><br>
        <label for="toppings_cherries"><input type="checkbox" name="toppings[]" id="toppings_cherries" value="cherries">Cherries</label><br>
        <label for="toppings_raisins"><input type="checkbox" name="toppings[]" id="toppings_raisins" value="raisins">Raisins</label><br>
        <label for="toppings_pretzels"><input type="checkbox" name="toppings[]" id="toppings_pretzels" value="pretzels">Pretzels</label><br>
        <label for="toppings_mms"><input type="checkbox" name="toppings[]" id="toppings_mms" value="mms">M&Ms</label><br>
        <label for="toppings_peanuts"><input type="checkbox" name="toppings[]" id="toppings_peanuts" value="peanuts">Peanuts</label><br>
        <label for="toppings_fudge"><input type="checkbox" name="toppings[]" id="toppings_fudge" value="fudge">Fudge</label><br>
        <label for="toppings_toasted_coconut"><input type="checkbox" name="toppings[]" id="toppings_toasted_coconut" value="toasted_coconut">Toasted Coconut</label><br>
        <label for="toppings_sliced_almonds"><input type="checkbox" name="toppings[]" id="toppings_sliced_almonds" value="sliced_almonds">Sliced Almonds</label><br>
        <label for="toppings_candy_canes"><input type="checkbox" name="toppings[]" id="toppings_candy_canes" value="candy_canes">Candy Canes</label><br>
        <label for="toppings_white_chocolate_chips"><input type="checkbox" name="toppings[]" id="toppings_white_chocolate_chips" value="white_chocolate_chips">White Chocolate Chips</label><br>
        <label for="toppings_pistachios"><input type="checkbox" name="toppings[]" id="toppings_pistachios" value="pistachios">Pistachios</label><br>
        <label for="toppings_brownie_bits"><input type="checkbox" name="toppings[]" id="toppings_brownie_bits" value="brownie_bits">Brownie Bits</label><br>
        <label for="toppings_cinnamon"><input type="checkbox" name="toppings[]" id="toppings_cinnamon" value="cinnamon">Cinnamon</label><br>
        <label for="toppings_graham_cracker"><input type="checkbox" name="toppings[]" id="toppings_graham_cracker" value="graham_cracker">Graham Cracker</label><br>
        <label for="toppings_smarties"><input type="checkbox" name="toppings[]" id="toppings_smarties" value="smarties">Smarties</label><br>
        <label for="toppings_cookie_dough"><input type="checkbox" name="toppings[]" id="toppings_cookie_dough" value="cookie_dough">Cookie Dough</label><br>

        <!-- Filling Options -->
        <h3>Filling:</h3>
        <label for="filling_none"><input type="radio" name="filling" id="filling_none" value="none" checked>None</label><br>
        <label for="filling_cream"><input type="radio" name="filling" id="filling_cream" value="cream">Cream</label><br>
        <label for="filling_jelly"><input type="radio" name="filling" id="filling_jelly" value="jelly">Jelly</label><br>

        <label for="quantity">Number of Donuts:</label>
        <input type="number" name="quantity" id="quantity" value="" min="1" required><br>

        <input type="submit" value="Submit Order">
    </form>
</body>

</html>