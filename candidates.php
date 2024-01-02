
<!-- students dropout
<?php
// Get input from the user
$shortlistedCandidates = intval(readline("Enter the number of shortlisted candidates: "));
$totalTurnout = intval(readline("Enter the total number of candidates who turned out: "));

// Calculate the percentage
if ($totalTurnout > 0) {
    $percentage = ($totalTurnout / $shortlistedCandidates) * 100;
    echo "Percentage of candidates who sat for the practical interview: " . number_format($percentage, 2) . "%\n";
} else {
    echo "Error: Total turnout should be greater than 0.\n";
}