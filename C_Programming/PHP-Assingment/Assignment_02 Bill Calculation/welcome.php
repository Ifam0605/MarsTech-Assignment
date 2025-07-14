<html>
<body>
    <h1>Your Total Bill</h1>

<?php
if (isset($_POST['calculate'])) {
    // Define prices
    $prices = [
        'biscuits' => 50,
        'noodles' => 100,
        'bread' => 40,
        'milk' => 60,
        'dhal' => 75
    ];

    $total = 0;

    foreach ($prices as $item => $price) {
        $qty = isset($_POST[$item]) ? (float)$_POST[$item] : 0;
        $cost = $qty * $price;
        $total += $cost;
    }

    // Display the total bill
    echo '<div id="total">Your Total Bill: Rs ' . number_format($total, 2) . '</div>';
    echo " <br>";
    
    // Add a link to go back or to another page
    echo '<a href="index.php" class="button">Go Back</a>';
}
    ?>



</body>

</html>