<html>
<head>
    <title><h2>Grocery Bill Calculator</h2></title>
    <link rel="stylesheet" href="basci.css">
</head>
<body>
    <div class="container">
        <h2>Grocery Bill Calculation</h2>
        <form method="post" action="welcome.php">
            <div class="item">
                <label for="biscuits">Biscuits (Rs50 each):</label>
                <input type="number" id="biscuits" name="biscuits" placeholder="1" >
            </div>
            <div class="item">
                <label for="noodles">Noodles (Rs100 each):</label>
                <input type="number" id="noodles" name="noodles" placeholder="0" >
            </div>
            <div class="item">
                <label for="bread">Bread (Rs40 each):</label>
                <input type="number" id="bread" name="bread" placeholder="0" >
            </div>
            <div class="item">
                <label for="milk">Milk (Rs60 each):</label>
                <input type="number" id="milk" name="milk" placeholder="0" >
            </div>
            <div class="item">
                <label for="dhal">Dhal (Rs75 each kg):</label> 
                <input type="number" id="dhal" name="dhal" placeholder="0" >
            </div>
            <button type="submit" name="calculate">Calculate Bill</button>
        </form>

       
    </div>
</body>
</html>