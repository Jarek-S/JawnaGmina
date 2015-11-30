
<?php
    //header('ContentType: text/json');
    //echo readfile('dane.json');
    //$file = file_get_contents('test.json');
    $data = json_decode(file_get_contents('test.json'),TRUE);
    //echo $data;
    $response = array();
    foreach($data as $transaction) {
        if (stristr($transaction['strona'],$_GET['nazwa'])) {
            $response[] = array('firma'=>$transaction['strona'],'kwota'=>$transaction['kwota'],'przedmiot'=>$transaction['przedmiot']);
        }
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
