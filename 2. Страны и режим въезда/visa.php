<?php
    if (count($argv) === 1) {
        echo 'Ошибка! Введите название страны.';
        exit;
    }

    $url = 'https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8';
    $altUrl = 'https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv';
    $data = file_get_contents($url);

    if ($data === false) {
        $data = file_get_contents($altUrl);
    }

    $destination = implode(" ", array_slice($argv, 1));
    $data = explode(PHP_EOL, $data);

    $arrayCountries = [];
    foreach ($data as $item) {
        $array = [];
        $array = explode(',', $item);
        $arrayCountries[] = $array;
    }

    $country;
    $visa;
    foreach ($arrayCountries as $item) {
        $place = trim($item[1], '"');
        if ($destination === $place) {
            $country = $place;
            $visa = trim($item[3], '"');
        }
    }

    if (isset($country) && isset($visa)) {
        echo "$country: $visa";
    } else {
        echo "$destination: страна не найдена";
    }
?>