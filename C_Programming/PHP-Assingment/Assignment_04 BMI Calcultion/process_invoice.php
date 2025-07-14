<?php
// process_invoice.php - Backend processing for the invoice system

// Set headers to return JSON
header('Content-Type: application/json');

// Check if the request is a POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

// Get form data
$shopName = isset($_POST['shopName']) ? trim($_POST['shopName']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$contactNumber = isset($_POST['contactNumber']) ? trim($_POST['contactNumber']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Validate required fields
if (empty($shopName) || empty($address) || empty($contactNumber) || empty($email)) {
    echo json_encode(['error' => 'All fields are required']);
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['error' => 'Invalid email address']);
    exit;
}

// Get item data
$itemCodes = isset($_POST['itemCode']) ? $_POST['itemCode'] : [];
$itemNames = isset($_POST['itemName']) ? $_POST['itemName'] : [];
$quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];
$unitPrices = isset($_POST['unitPrice']) ? $_POST['unitPrice'] : [];

// Process items
$items = [];
$totalBeforeDiscount = 0;
$totalQuantity = 0;

for ($i = 0; $i < count($itemCodes); $i++) {
    // Skip empty items
    if (empty($itemCodes[$i]) || empty($itemNames[$i]) || empty($quantities[$i]) || empty($unitPrices[$i])) {
        continue;
    }
    
    $quantity = intval($quantities[$i]);
    $unitPrice = floatval($unitPrices[$i]);
    $totalPrice = $quantity * $unitPrice;
    
    // Add to totals
    $totalBeforeDiscount += $totalPrice;
    
    $items[] = [
        'itemCode' => $itemCodes[$i],
        'itemName' => $itemNames[$i],
        'quantity' => $quantity,
        'unitPrice' => $unitPrice,
        'totalPrice' => $totalPrice
    ];
}

// Calculate discounts based on the rules
$discount = 0;

foreach ($items as &$item) {
    $quantity = $item['quantity'];
    
    // Calculate discount based on quantity
    if ($quantity > 50) {
        // For each 50 items, 5 items are given free
        $freeItemsForThisItem = floor($quantity / 50) * 5;
        $discountForThisItem = $freeItemsForThisItem * $item['unitPrice'];
        $discount += $discountForThisItem;
    } elseif ($quantity > 20) {
        // 10% discount for quantities greater than 20
        $discountForThisItem = $item['totalPrice'] * 0.10;
        $discount += $discountForThisItem;
    } elseif ($quantity > 10) {
        // 2% discount for quantities greater than 10
        $discountForThisItem = $item['totalPrice'] * 0.02;
        $discount += $discountForThisItem;
    }
}

// Calculate total after discount
$total = $totalBeforeDiscount - $discount;

// Prepare response
$response = [
    'shopName' => $shopName,
    'address' => $address,
    'contactNumber' => $contactNumber,
    'email' => $email,
    'items' => $items,
    'totalBeforeDiscount' => $totalBeforeDiscount,
    'discount' => $discount,
    'total' => $total,
];

// Return JSON response
echo json_encode($response);
?>