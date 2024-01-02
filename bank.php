<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>

<?php
class BankAccount {
    private $accountNumber;
    private $accountHolder;
    private $balance;

    public function __construct($accountNumber, $accountHolder, $initialBalance) {
        $this->accountNumber = $accountNumber;
        $this->accountHolder = $accountHolder;
        $this->balance = $initialBalance;
    }

    public function deposit($amount) {
        $this->balance += $amount;
        return $this->balance;
    }

    public function withdraw($amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
            return $this->balance;
        } else {
            return "Insufficient funds!";
        }
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getAccountInfo() {
        return "Account Number: " . $this->accountNumber . "<br>" .
               "Account Holder: " . $this->accountHolder . "<br>" .
               "Balance: $" . $this->balance;
    }
}

// Initialize account with initial balance
$accountNumber = "123456789";
$accountHolder = "John Doe";
$initialBalance = 1000.00;
$bankAccount = new BankAccount($accountNumber, $accountHolder, $initialBalance);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["createAccount"])) {
        // Implement account creation logic if needed
    } elseif (isset($_POST["deposit"])) {
        $depositAmount = floatval($_POST["deposit"]);
        $bankAccount->deposit($depositAmount);
    } elseif (isset($_POST["withdraw"])) {
        $withdrawAmount = floatval($_POST["withdraw"]);
        $bankAccount->withdraw($withdrawAmount);
    }
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="deposit">Deposit Amount:</label>
    <input type="number" step="0.01" name="deposit" id="deposit" required>
    <button type="submit">Deposit</button>
</form>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="withdraw">Withdraw Amount:</label>
    <input type="number" step="0.01" name="withdraw" id="withdraw" required>
    <button type="submit">Withdraw</button>
</form>

<p>Remaining Balance: $<?php echo $bankAccount->getBalance(); ?></p>

<form>
    <label for="viewUserInfo">View User Information:</label>
    <button type="button" onclick="viewUserInfo()">View User Information</button>
</form>

<form>
    <label for="viewAccountInfo">View Bank Account Information:</label>
    <button type="button" onclick="viewAccountInfo()">View Bank Account Information</button>
</form>

<script>
    function viewUserInfo() {
        alert("User Information:\n<?php echo $bankAccount->getAccountInfo(); ?>");
    }

    function viewAccountInfo() {
        alert("Bank Account Information:\n<?php echo $bankAccount->getAccountInfo(); ?>");
    }
</script>

</body>
</html>
