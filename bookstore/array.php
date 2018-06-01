<?php
$empty1 = [];
$empty2 = array();
$names1 = ['Harry', 'Ron', 'Hermione'];
$names2 = array('Harry', 'Ron', 'Hermione');
$status1 = [
'name' => 'James Potter',
'status' => 'dead'
];
$status2 = array(
'name' => 'James Potter',
'status' => 'dead'
);

$names = ['Harry', 'Ron', 'Hermione'];
$status = [
'name' => 'James Potter',
'status' => 'dead',
];
$names[] = 'Neville';
$status['age'] = 32;

print_r($names);
echo('<br>');
print_r($status);
echo('<br>');
$names = ['Harry', 'Ron', 'Hermione'];
$names['badguy'] = 'Voldemort';
$names[8] = 'Snape';
$names[] = 'McGonagall';
print_r($names);
