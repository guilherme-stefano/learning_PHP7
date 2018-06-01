<?php
$properties = [
'firstname' => 'Tom',
'surname' => 'Riddle',
'house' => 'Slytherin'
];
$properties1 = $properties2 = $properties3 = $properties;
sort($properties1);
var_dump($properties1);
echo '<br>';
asort($properties3);
var_dump($properties3);
echo '<br>';
ksort($properties2);
var_dump($properties2);
echo '<br>';