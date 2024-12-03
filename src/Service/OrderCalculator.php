<?php

// src/Service/OrderCalculator.php
namespace App\Service;

use App\Entity\Order;

class OrderCalculator
{
    public function calculateTotal(Order $order): float
    {
        $total = 0;
        foreach ($order->getOrderItems() as $item) {
            $total += $item->getQuantity() * $item->getUnitPrice();
        }
        return $total;
    }

    public function applyDiscount(float $total, float $discount): float
    {
        return $total - ($total * $discount / 100);
    }
}
