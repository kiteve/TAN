<?php

// Define constants
define('HOURS_PER_DAY', 8);
define('HOURLY_RATE', 30375);
define('DAYS_PER_MONTH', 30);

// Function to calculate total monthly salary
function calculateMonthlySalary($hoursPerDay, $hourlyRate, $daysPerMonth) {
    $totalSalary = $hoursPerDay * $hourlyRate * $daysPerMonth;
    return $totalSalary;
}

// Calculate and display the total monthly salary
$totalSalary = calculateMonthlySalary(HOURS_PER_DAY, HOURLY_RATE, DAYS_PER_MONTH);

echo "Total Monthly Salary for the Company: $" . number_format($totalSalary, 2);

?>
