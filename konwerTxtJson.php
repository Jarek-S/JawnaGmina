<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
<?php
    
/*
Pobiera dane z pliku tekstowego i przetwarza na plik JSON.
Format wejściowy: płatnik, pusta linia, sekwencje - numer, symbol dokumentu,
przedmiot umowy, kwota, data wypłaty, strona umowy.
Każde pole w nowej linii.
*/
    define('PLIK_WE', 'umowy.txt');
    define('PLIK_WY', 'dane.json');

    ($dane = file(PLIK_WE, FILE_IGNORE_NEW_LINES)) or die("Nie udało się otworzyć pliku wejściowego");
//tworzymy tablicę asocjacyjnych tablic - rekordów opisujących transakcje    
    if (((count($dane)-2)%6)==0) {
        for ($i=2, $j=0; $i<count($dane); $i=$i+6, $j++) {
            $items[$j] = array(
                "lp" => $dane[$i],
                "symbol" => $dane[$i+1],
                "przedmiot" => $dane[$i+2],
                "kwota" => $dane[$i+3],
                "okres" => $dane[$i+4],
                "strona" => $dane[$i+5]
            );
        }
    echo "Tabela transakcji zawiera ".count($items)." rekordów.</br>";
//tworzymy tablicę kontrahentów (bez powtórzeń)
    foreach($items as $item) {
        $clients[] = $item['strona'];
    }
    $clients_unique = array_unique($clients);
    echo "Liczba kontrahentów to ".count($clients_unique).".</br>";
    foreach($clients_unique as $client) {
        echo $client."</br>";
    }
//montujemy tablicę z transakcji, płatnika i listy kontrahentów
    $transactions = array(
        "zleceniodawca" => $dane[0],
        "kontrahenci" => $clients_unique,
        "transakcje" => $items
    );
//i zapisujemy ją do pliku w formacie JSON
    ($file = fopen(PLIK_WY, "w+")) or die("Nie udało się otworzyć pliku do zapisu.");
    (fputs($file, json_encode($transactions, JSON_UNESCAPED_UNICODE))) or die("Zapis nieudany.");
    fclose($file);
    }
    else echo "Nieprawidłowa liczba pozycji";
?>
    </body>
</html>
