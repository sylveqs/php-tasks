<?php

$iterations = 50;
$url = "http://localhost:8000/api.php?id=";
$totalTime = 0;
$errors = 0;

$startAll = microtime(true);

for ($i = 0; $i < $iterations; $i++) {

    $ch = curl_init($url . $i);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $start = microtime(true);

    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $end = microtime(true);

    $requestTime = $end - $start;
    $totalTime += $requestTime;

    if ($httpCode !== 200) {
        $errors++;
    }

    curl_close($ch);
}

$endAll = microtime(true);

$totalExecutionTime = $endAll - $startAll;
$avgTime = $totalTime / $iterations;

// Вывод
echo "Итераций: $iterations\n";
echo "Общее время: " . round($totalExecutionTime, 4) . " сек\n";
echo "Среднее время запроса: " . round($avgTime, 4) . " сек\n";
echo "Ошибки: $errors\n";