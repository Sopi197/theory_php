<?php

// php в примерах и задачах [Васильев] - 124 стр. Функции

// В качестве индексов массива можно использовать не только целые числа, но и текст. В таком случае вместо термина «индекс», как правило, используют термин «ключ». Массив с текстовыми ключами обычно называют ассоциативным массивом.
// массив с индексными ключами == список
// ассоциативный массив == словарь, таблица

$arr = ["one" => 1, "two" => 2, "three" => "str"];

// альтернативная запись foreach
foreach($arr as $key => $value):
    if(is_string($value)) {
        echo "$value - удаляем \n";
        unset($arr[$key]);
    }
    else {
        echo "$value - оставляем \n";
    }
endforeach;
print_r($arr);

$x = 10;
$y = $x;
$y = 10 + 10;
var_dump($x); // 10
var_dump($y); // 20

// передача переменной по ссылке &. Переменные $x и $y ссылаются на одну и ту же область памяти
$x = 10;
$y = &$x;
$y = 10 + 1;
var_dump($x); // 11
var_dump($y); // 11

$arr = [100, 200, 300];

foreach ($arr as $value):
    $value++;
endforeach;
print_r($arr); // [100, 200, 300] - значение массива не меняется

foreach ($arr as &$value):
    $value++;
endforeach;
print_r($arr); // [101, 201, 301]

$complex_arr = [[1, 2, 3], ["10", 33, 100], ['str', 10, "hello"]];

for ($i = 0; $i < count($complex_arr); $i++) {
    for ($k = 0; $k < count($complex_arr[$i]); $k++) {
        echo "Элемент массива: " . $complex_arr[$i][$k] . "\n";
    }
    echo "\n";
}
// или
foreach ($complex_arr as $key => $value) {
    foreach ($value as $val) {
        echo "Элемент массива: " . $val . " \n";
    }
    echo "\n";
}

// приведение типов для ключей массива выполняется автоматически
var_dump([1, 2, "2" => 3] === [1, 2, 3]); // true


