<?php
    $data = json_decode(file_get_contents('test.json'),TRUE);
    $response = array();
    foreach($data as $transaction) {
        if (stristr($transaction['strona'],$_GET['nazwa'])) {
            $response[] = array('firma'=>$transaction['strona'],
                                'kwota'=>$transaction['kwota'],
                                'przedmiot'=>$transaction['przedmiot']);
        }
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
