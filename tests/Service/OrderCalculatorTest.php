<?php

// tests/Service/OrderCalculatorTest.php
namespace App\Tests\Service;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Service\OrderCalculator;
use PHPUnit\Framework\TestCase;

class OrderCalculatorTest extends TestCase
{
    public function testCalculateTotal(): void
    {
        $order = new Order();

        $item1 = new OrderItem();
        $item1->setQuantity(2);
        $item1->setUnitPrice(50);

        $item2 = new OrderItem();
        $item2->setQuantity(1);
        $item2->setUnitPrice(100);

        $order->addOrderItem($item1);
        $order->addOrderItem($item2);

        $calculator = new OrderCalculator();
        $this->assertEquals(200, $calculator->calculateTotal($order));
    }

    public function testApplyDiscount(): void
    {
        $calculator = new OrderCalculator();
        $total = 200;

        $this->assertEquals(180, $calculator->applyDiscount($total, 10));
    }
}
