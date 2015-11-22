<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
<?php
    define('PLIK_WE', 'umowy.txt');
    define('PLIK_WY', 'dane.json');
    $dane = file(PLIK_WE, FILE_IGNORE_NEW_LINES);
    if (((count($dane)-8)%6)==0) {
        for ($i=8, $j=0; $i<count($dane); $i=$i+6, $j++) {
            $items[$j] = array(
                "lp" => $dane[$i],
                "symbol" => $dane[$i+1],
                "przedmiot" => $dane[$i+2],
                "kwota" => $dane[$i+3],
                "okres" => $dane[$i+4],
                "strona" => $dane[$i+5]
            );
        }
    echo "Baza danych zawiera ".count($items)." pozycji.";
    
    $header = array(
        "zleca" => $dane[0],
        "wydzial" => $dane[1],
        "col_lp" => $dane[2],
        "col_symbol" => $dane[3],
        "col_przedmiot" => $dane[4],
        "col_kwota" => $dane[5],
        "col_okres" => $dane[6],
        "col_strona" => $dane[7],
        "dane" => $items
    );
    echo json_encode($header, JSON_UNESCAPED_UNICODE);
    }
    else echo "Nieprawidłowa liczba pozycji";
?>
    </body>
</html>
