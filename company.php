<?php
class BudgetTracker {
    private $budget;
    private $remainingAmount;
    private $daysRemaining;

    public function __construct($budget, $daysRemaining) {
        $this->budget = $budget;
        $this->remainingAmount = $budget;
        $this->daysRemaining = $daysRemaining;
    }

    public function spend($amount) {
        if ($amount <= $this->remainingAmount) {
            $this->remainingAmount -= $amount;
            return true; // Successfully spent
        } else {
            return false; // Insufficient funds
        }
    }

    public function updateDaysRemaining($days) {
        $this->daysRemaining = $days;
    }

    public function getRemainingAmount() {
        return $this->remainingAmount;
    }

    public function getDaysRemaining() {
        return $this->daysRemaining;
    }

    public function checkLowBudget() {
        if ($this->remainingAmount < ($this->budget * 0.1)) {
            return true; // Budget is low, provide a warning
        } else {
            return false; // Budget is okay
        }
    }
}

// Initialize BudgetTracker with initial values
$initialBudget = 500; // Initial budget amount
$initialDaysRemaining = 30; // Initial number of days
$budgetTracker = new BudgetTracker($initialBudget, $initialDaysRemaining);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["spend"])) {
        $amountSpent = floatval($_POST["amountSpent"]);
        if ($budgetTracker->spend($amountSpent)) {
            echo "Spent $amountSpent. ";
        } else {
            echo "Insufficient funds. ";
        }
    } elseif (isset($_POST["updateDays"])) {
        $newDaysRemaining = intval($_POST["newDaysRemaining"]);
        $budgetTracker->updateDaysRemaining($newDaysRemaining);
    }
}

// Display remaining amount and days remaining
echo "Remaining Amount: $" . $budgetTracker->getRemainingAmount() . "<br>";
echo "Days Remaining: " . $budgetTracker->getDaysRemaining() . "<br>";

// Check if budget is low and provide a warning
if ($budgetTracker->checkLowBudget()) {
    echo "<strong>Warning:</strong> Your remaining budget is low!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="amountSpent">Enter Amount Spent:</label>
    <input type="number" step="0.01" name="amountSpent" id="amountSpent" required>
    <button type="submit" name="spend">Spend</button>
</form>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="newDaysRemaining">Update Days Remaining:</label>
    <input type="number" name="newDaysRemaining" id="newDaysRemaining" required>
    <button type="submit" name="updateDays">Update Days</button>
</form>

</body>
</html>
