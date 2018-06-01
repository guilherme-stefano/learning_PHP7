<?php
echo "with while: ";
echo '</br>';
$i = 1;
while ($i < 0) {
echo $i . " ";
echo '</br>';
$i++;
}
echo "with do-while: ";
echo '</br>';
$i = 1;
do {
echo $i . " ";
echo '</br>';
$i++;
} while ($i < 0);
for ($i = 1; $i < 10; $i++) {
echo $i . " ";
echo '</br>';
}
$names = ['Harry', 'Ron', 'Hermione'];
for ($i = 0; $i < count($names); $i++) {
echo $names[$i] . " ";
echo $i . " ";
echo '</br>';
}
echo '</br>';
$i = 0;
while ($i < 3) {
echo $i . " ";
echo '</br>';
$i++;
}