<?php

// tests/Entity/ProductTest.php
namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductEntity(): void
    {
        $product = new Product();
        $product
            ->setName('Laptop')
            ->setPrice(1200);

        $this->assertEquals('Laptop', $product->getName());
        $this->assertEquals(1200, $product->getPrice());
    }

    public function testWithInvalidTypeName(): void
    {
        $this->expectException(\TypeError::class);

        $product = new Product();
        $product->setName([]);
    }

    public function testWithInvalidTypePrice(): void
    {
        $this->expectException(\TypeError::class);

        $product = new Product();
        $product->setPrice("This is not a price");
    }
}
