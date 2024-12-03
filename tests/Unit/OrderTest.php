<?php

namespace App\Tests\Unit;

use App\Entity\Order;
use App\Entity\OrderItem;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testOrderWithItems(): void
    {
        $order = new Order();
        $item1 = new OrderItem();
        $item2 = new OrderItem();

        $order->addOrderItem($item1)
            ->addOrderItem($item2);

        $this->assertCount(2, $order->getOrderItems());
        $this->assertSame($order, $item1->getRelatedOrder());
        $this->assertSame($order, $item2->getRelatedOrder());
    }
}
