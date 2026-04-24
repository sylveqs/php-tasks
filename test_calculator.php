<?php

require_once 'calculator.php';

function runTest($name, $callback) {
    try {
        $callback();
        echo "Тест '{$name}' пройден.\n";
    } catch (Exception $e) {
        echo "Тест '{$name}' провален: " . $e->getMessage() . "\n";
    }
}

// положительный тест
runTest('Скидка 10%', function() {
    $result = calculateDiscount(1000, 10);
    if (abs($result - 900) > 0.0001) throw new Exception("Неверный результат");
});

// граничное значение (0%)
runTest('Скидка 0%', function() {
    $result = calculateDiscount(1000, 0);
    if ($result !== 1000) throw new Exception("Неверный результат");
});

// граничное значение (100%)
runTest('Скидка 100%', function() {
    $result = calculateDiscount(1000, 100);
    if ($result !== 0) throw new Exception("Неверный результат");
});

//негативный тест (скидка > 100)
runTest('Скидка больше 100%', function() {
    try {
        calculateDiscount(1000, 150);
        throw new Exception("Ожидалось исключение");
    } catch (InvalidArgumentException $e) {
        // ок, тест пройден
    }
});

// негативный тест (отрицательная цена)
runTest('Отрицательная цена', function() {
    try {
        calculateDiscount(-500, 10);
        throw new Exception("Ожидалось исключение");
    } catch (InvalidArgumentException $e) {
    }
});