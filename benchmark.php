<?php

// Алгоритм 1 — наивный
function findPrimesNaive($n) {
    $primes = [];

    for ($i = 2; $i <= $n; $i++) {
        $isPrime = true;

        for ($j = 2; $j < $i; $j++) {
            if ($i % $j == 0) {
                $isPrime = false;
                break;
            }
        }

        if ($isPrime) {
            $primes[] = $i;
        }
    }

    return $primes;
}

// Алгоритм 2 — оптимизированный (решето Эратосфена)
function findPrimesSieve($n) {
    $sieve = array_fill(0, $n + 1, true);
    $sieve[0] = $sieve[1] = false;

    for ($i = 2; $i * $i <= $n; $i++) {
        if ($sieve[$i]) {
            for ($j = $i * $i; $j <= $n; $j += $i) {
                $sieve[$j] = false;
            }
        }
    }

    $primes = [];
    for ($i = 2; $i <= $n; $i++) {
        if ($sieve[$i]) {
            $primes[] = $i;
        }
    }

    return $primes;
}

// функция для замера среднего времени
function benchmark($callback, $runs = 10) {
    $totalTime = 0;

    for ($i = 0; $i < $runs; $i++) {
        $start = microtime(true);

        $callback();

        $end = microtime(true);
        $totalTime += ($end - $start);
    }

    return $totalTime / $runs;
}

$N = 10000;

$timeNaive = benchmark(function() use ($N) {
    findPrimesNaive($N);
});

$timeSieve = benchmark(function() use ($N) {
    findPrimesSieve($N);
});

$speedup = $timeNaive / $timeSieve;

echo "N = $N\n";
echo "Наивный алгоритм: " . round($timeNaive, 5) . " сек\n";
echo "Решето Эратосфена: " . round($timeSieve, 5) . " сек\n";
echo "Ускорение: x" . round($speedup, 2) . "\n";