<?php
// we wanted the output of only selected array_keys from a big array from a csv-table
// with different order of keys, with optional suppressing of empty or unused values

function show($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}




$values = array('24497','LED','E27','10W','');
$keys = array('Controller','Method','Param1','Param2','Param3');
$URL = array_combine($keys,$values);

$notempty = array_filter($URL, 'strlen'); // strlen used as the callback-function with 0==false
print('$notempty:');


$size = count($values);

show($values);
show($keys);
show($URL);
show($notempty);


/*
Array
(
    [Article] => 24497
    [Wattage] => 10W
    [Dimmable] => 
    [Type] => LED
    [Foobar] => 
)
Array
(
    [Article] => 24497
    [Wattage] => 10W
    [Type] => LED
)
*/
?>