<?php

$sample_essay = "Speed is a scalar quantity. Velocity is a vector quantity, but speed is not vector quantity, but as a scalar quantity. Distance is not the same as displacement. Speed - a rate of distance covered within a certain given time or more so on the rate of change from its starting position to its current one.

Velocity - it focuses on speed, the object's quickness rather than the possible distance it covers in a shorter amount of time.

Distance - the amount an object would cover at a certain given time.

Displacement - the whole journey/action/process of an object, which would be the starting point up until the end point.

Speed - The rate of change of position of an object in any direction.

Velocity - It is the rate of change of distance.

Distance - the total movement of an object without any regard to direction.

Displacement - the change in position of an object.";

$sample_essay = preg_replace('/\s+/', ' ', str_replace('/', ' ', str_replace([',', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '-', '+', '=', '{', '}', '[', ']', '|', '\\', ':', ';', '"', '<', '>', ',', '?', '~', '`', PHP_EOL], '',$sample_essay)));

// echo $sample_essay;

$raw_sentences = array_filter(explode(".", $sample_essay));

for($i = 1; $i < count($raw_sentences); $i++){
    if($raw_sentences[$i][0] == " "){
        $raw_sentences[$i] = substr($raw_sentences[$i], 1);
    }
}

// print_r($raw_sentences);

$negating_words = array("aren't", "but", "can't", "cannot", "couldn't", "didn't", "doesn't", "don't", "hadn't", "hasn't", "haven't", "isn't", "mustn't", "no", "nor", "not", "shan't", "shouldn't", "unless", "wasn't", "weren't", "won't", "wouldn't");

$irregular_negating_words = array('not just', 'not only', 'not purely', 'not exclusively', 'not merely', 'not solely', 'not simply', 'not uniquely');

$raw_statements = array();

for($i = 0; $i < count($raw_sentences); $i++){
    $detect = 0;
    for($y = 0; $y < count($irregular_negating_words); $y++){
        if(str_contains($raw_sentences[$i], $irregular_negating_words[0])){
            $raw_sentences[$i][strpos($raw_sentences[$i], $irregular_negating_words[0])+3] = '_';
            $detect -= 1;
        }
    }
    $words = explode(' ', $raw_sentences[$i]);
    $statement = "";
    for($x = 0; $x < count($words); $x++){
        if(in_array($words[$x], $negating_words) && count(explode(' ',substr($statement, 0, strlen($statement) - 1))) > 2){
            $detect += 1;
        }
        if($detect == 1){
            array_push($raw_statements, $statement);
            $statement = "";
            $detect += 1;
        }
        else if($detect < 1 || $detect > 1){
            $statement = $statement.$words[$x]." ";
        }
    }
    
    array_push($raw_statements, $statement);
}

print_r($raw_statements);

// count(explode(' ',substr($statement, 0, strlen($statement) - 1))) < count(explode(' ',substr($statement, 0, strlen($statement) - 1))) - count(explode(' ',$raw_sentences[$i]))







// print_r($raw_sentences);

?>