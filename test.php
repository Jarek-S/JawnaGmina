<?php
$tablica = array();
$tablica[] = array('firma'=>'Blue', 'kwota'=>5000.00, 'przedmiot'=>'mycie podłogi');
$tablica[] = array('firma'=>'Green', 'kwota'=>3000.00, 'przedmiot'=>'dostawa kwiatów');
$tablica[] = array('firma'=>'Blue', 'kwota'=>6000.00, 'przedmiot'=>'reklama na chodniku');
echo json_encode($tablica, JSON_UNESCAPED_UNICODE);
?>