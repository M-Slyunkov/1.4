<?php 
    if (!isset($argv[1])) {
        echo 'Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}';
        exit;
    } elseif ($argv[1] === '--today') {
        if (file_exists('money.csv')) {
            $result = 0;
            $resourse = fopen('money.csv', 'r');
            if ($resourse !== false) {
                while (($data = fgetcsv($resourse, 250)) !== false) {
                    if ($data[0] === date('Y-m-d')) {
                    $result += $data[1];
                    }
                }
            }
            fclose($resourse);
            echo "Расход за день: $result";
            exit;
        }
        echo 'Ошибка! Список ещё не создан';
        exit;
    } elseif (!is_numeric($argv[1])) {
        echo 'Ошибка! Введите числовое значение стоимости';
        exit;
    } elseif (!isset($argv[2])) {
        echo 'Ошибка! Добавьте описание';
        exit;
    }
    $cost = $argv[1];
    $arraySlice = array_slice($argv, 2);
    $description = implode(" ", $arraySlice);
    $newArray = [date('Y-m-d'), $cost, $description];
    $resourse = fopen('money.csv', 'a');
    fputcsv($resourse, $newArray);
    fclose($resourse);
    echo "Добавлена строка: {$newArray[0]}, {$newArray[1]}, {$newArray[2]}";
?>