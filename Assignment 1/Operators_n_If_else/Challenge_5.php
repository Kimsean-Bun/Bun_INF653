<?php
    $input = 1900;
    
    echo "<pre>";
    echo "Input: ". $input. "\n";

    if ($input % 4 == 0 && $input % 100 != 0 || $input % 400 == 0){
        echo "Output: ". $input. " is a leap year";
    } else {
        echo "Output: ". $input. " is a not leap year";
    }
    echo "<pre>";
?>