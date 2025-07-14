<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Shop Invoice Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container, .invoice-container {
            border: 1px solid #ccc;
            padding: 20px;
            width: 50%;
            margin: 20px 0;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
        }
        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        .form-container button {
            padding: 10px 20px;
            margin-right: 10px;
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .item-row input {
            width: 23%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>ABC Shop Invoice Generator</h2>
    <div class="form-container">
        <form method="POST" action="">
            <label for="shop_name">Shop Name:</label>
            <input type="text" id="shop_name" name="shop_name" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <h3>Items</h3>
            <div id="items">
                <div class="item-row">
                    <input type="text" name="item_code[]" placeholder="Item Code" required>
                    <input type="text" name="item_name[]" placeholder="Item Name" required>
                    <input type="number" name="quantity[]" placeholder="Quantity" required>
                    <input type="number" name="unit_price[]" placeholder="Unit Price (Rs)" step="0.01" required>
                </div>
            </div>
            <button type="button" onclick="addItem()">Add Another Item</button>
            <br><br>
            <button type="submit" name="submit">Submit</button>
            <button type="reset">Clear</button>
        </form>
    </div>

    <script>
        function addItem() {
            const itemsDiv = document.getElementById('items');
            const newItemRow = document.createElement('div');
            newItemRow.className = 'item-row';
            newItemRow.innerHTML = `
                <input type="text" name="item_code[]" placeholder="Item Code" required>
                <input type="text" name="item_name[]" placeholder="Item Name" required>
                <input type="number" name="quantity[]" placeholder="Quantity" required>
                <input type="number" name="unit_price[]" placeholder="Unit Price (Rs)" step="0.01" required>
            `;
            itemsDiv.appendChild(newItemRow);
        }
    </script>

    <?php
    if (isset($_POST['submit'])) {
        // Collect shop details
        $shop_name = htmlspecialchars($_POST['shop_name']);
        $address = htmlspecialchars($_POST['address']);
        $contact_number = htmlspecialchars($_POST['contact_number']);
        $email = htmlspecialchars($_POST['email']);

        // Collect item details
        $item_codes = $_POST['item_code'];
        $item_names = $_POST['item_name'];
        $quantities = $_POST['quantity'];
        $unit_prices = $_POST['unit_price'];

        $total = 0;
        $items = [];

        // Process each item
        for ($i = 0; $i < count($item_codes); $i++) {
            $item_code = htmlspecialchars($item_codes[$i]);
            $item_name = htmlspecialchars($item_names[$i]);
            $quantity = intval($quantities[$i]);
            $unit_price = floatval($unit_prices[$i]);

            // Calculate free items (1 free for every 30 items)
            $free_items = floor($quantity / 30);
            $payable_quantity = $quantity - $free_items;

            // Calculate subtotal before discount
            $subtotal = $payable_quantity * $unit_price;

            // Apply discounts
            $discount = 0;
            if ($quantity > 20) {
                $discount = 0.05; // 5% discount
            } elseif ($quantity > 10) {
                $discount = 0.20; // 20% discount
            }

            $discount_amount = $subtotal * $discount;
            $subtotal_after_discount = $subtotal - $discount_amount;

            // Add to total
            $total += $subtotal_after_discount;

            // Store item details for display
            $items[] = [
                'code' => $item_code,
                'name' => $item_name,
                'quantity' => $quantity,
                'free_items' => $free_items,
                'price' => $subtotal_after_discount
            ];
        }

        // Display the invoice
        echo '<div class="invoice-container">';
        echo '<h3>' . $shop_name . ' - Invoice</h3>';
        echo '<p><strong>Address:</strong> ' . $address . '</p>';
        echo '<p><strong>Contact Number:</strong> ' . $contact_number . '</p>';
        echo '<p><strong>Email:</strong> ' . $email . '</p>';
        echo '<table>';
        echo '<tr><th>Item Code</th><th>Item Name</th><th>Quantity</th><th>Free Items</th><th>Price (Rs)</th></tr>';
        foreach ($items as $item) {
            echo '<tr>';
            echo '<td>' . $item['code'] . '</td>';
            echo '<td>' . $item['name'] . '</td>';
            echo '<td>' . $item['quantity'] . '</td>';
            echo '<td>' . $item['free_items'] . '</td>';
            echo '<td>' . number_format($item['price'], 2) . '</td>';
            echo '</tr>';
        }
        echo '<tr><td colspan="4"><strong>Total</strong></td><td><strong>' . number_format($total, 2) . '</strong></td></tr>';
        echo '</table>';
        echo '</div>';
    }
    ?>
</body>
</html>