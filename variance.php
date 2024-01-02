Write a program to calculate mean,variance and standard deviation of these numbers
10,18,15,30,25,20,32,40,10

<?php
// Array of numbers
$numbers = [10, 18, 15, 30, 25, 20, 32, 40, 10];

// Calculate the mean
$mean = array_sum($numbers) / count($numbers);

// Calculate the variance
$sumOfSquares = 0;
foreach ($numbers as $number) {
    $sumOfSquares += ($number - $mean) ** 2;
}
$variance = $sumOfSquares / count($numbers);

// Calculate the standard deviation
$standardDeviation = sqrt($variance);

// Display the results
echo "Numbers: " . implode(', ', $numbers) . "<br>";
echo "Mean: $mean<br>";
echo "Variance: $variance<br>";
echo "Standard Deviation: $standardDeviation<br>";
?>