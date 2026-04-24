<?php

function calculateDiscount($price, $percent) {
    if (!is_numeric($price) || !is_numeric($percent)) {
        throw new InvalidArgumentException("Цена и процент должны быть числами");
    }

    if ($price < 0) {
        throw new InvalidArgumentException("Цена не может быть отрицательной");
    }

    if ($percent < 0 || $percent > 100) {
        throw new InvalidArgumentException("Скидка должна быть от 0 до 100%");
    }

    // Расчет
    $discount = $price * ($percent / 100);
    return $price - $discount;
}