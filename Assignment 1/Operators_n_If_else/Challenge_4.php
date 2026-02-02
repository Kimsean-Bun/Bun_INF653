<?php
    echo "<pre>";
    $input = 85;
    echo "Input: ". $input. "\n";

    echo "Output: You got a ";
    if ($input >= 90){
        echo "A!";
    } elseif ($input >= 80){
        echo "B!";
    } elseif ($input >= 70){
        echo "C!";
    } elseif ($input >= 60){
        echo "D!";
    } else{
        echo "F!";
    }
    echo "<pre>";
?>