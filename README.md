![separe](https://github.com/studoo-app/.github/blob/main/profile/studoo-banner-logo.png)
# CYBER TP2 SIO 4 : Pratique des Tests Unitaires et Développement Piloté par les Tests (TDD)
[![Version](https://img.shields.io/badge/Version-2024-blue)]()

## Objectif
Ce TP vise à renforcer vos compétences dans l’écriture et l’exécution de tests unitaires avec Symfony. 
Il vous permettra également de pratiquer le développement piloté par les tests (TDD) pour construire un service métier.
Vous couvrirez des tests sur des entités, services, contrôleurs et repositories, tout en explorant les bonnes pratiques
des tests unitaires.

## Contexte

Vous allez construire et tester une application Symfony pour gérer un magasin en ligne. Les principales fonctionnalités
incluent la gestion des clients, des produits et des commandes, ainsi que le calcul du total des commandes.

## Missions

### 1 - Tester une Entité Simple
 - Créer une entité `Product` avec les attributs suivants :
   - name (string)
   - price (float)
 - Créer un test unitaire pour vérifier que l’entité `Product` est valide.

### 2 - Tester une entité complexe avec des relations
- Créer une entité `Order`
- Créer une entité `OrderItem`
- Créer une relation entre `Order` et `OrderItem`
  - Une entité Order peut contenir plusieurs `OrderItem`
  - Un OrderItem appartient à une seule entité `Order`
- Créer un test unitaire pour vérifier que l’entité `Order` est valide.

### 3 - Tester un service
- Créer le service `OrderCalculator`:
    ```php
    // src/Service/OrderCalculator.php
    namespace App\Service;
    
    use App\Entity\Order;
    
    class OrderCalculator
    {
        public function calculateTotal(Order $order): float
        {
            $total = 0;
            foreach ($order->getItems() as $item) {
                $total += $item->getQuantity() * $item->getUnitPrice();
            }
            return $total;
        }
    
        public function applyDiscount(float $total, float $discount): float
        {
            return $total - ($total * $discount / 100);
        }
    }
    ```
- Créer un test unitaire pour vérifier que les 2 méthodes du service `OrderCalculator` sont valides.

### 4 - Tester un contrôleur

- Créer un contrôleur `ProductController` avec une méthode list :
    ```php
    // src/Controller/ProductController.php
    #[Route('/products', name: 'product_list')]
    public function list(): JsonResponse
    {
        return new JsonResponse([
            new Product(['name' => 'Laptop', 'price' => 1200]),
            new Product(['name' => 'Smartphone', 'price' => 800]),
        ]);
    }
    ```
- Créer un test unitaire pour vérifier que la méthode list du contrôleur `ProductController` est valide.

### 5 - Tester un repository
- Créer une méthode `findExpensiveProducts` dans le repository `ProductRepository`:
    ```php
    public function findExpensiveProducts(float $price): array
        {
            return $this->createQueryBuilder('p')
                ->where('p.price > :price')
                ->setParameter('price', $price)
                ->getQuery()
                ->getResult();
        }
    ```
- Créer un test unitaire pour vérifier que la méthode `findExpensiveProducts` du repository `ProductRepository` est valide.

### 6 - Pratiquer le TDD

Nous allons écrire un test pour un service `StockManager` qui réduit le stock d’un produit. 
Le test est écrit avant même d’implémenter la méthode `reduceStock`.

```php
// tests/Service/StockManagerTest.php
namespace App\Tests\Service;

use App\Entity\Product;
use App\Service\StockManager;
use PHPUnit\Framework\TestCase;

class StockManagerTest extends TestCase
{
    public function testReduceStock(): void
    {
        $product = new Product();
        $product->setName('Laptop')->setPrice(1200)->setStock(10);

        $manager = new StockManager();
        $manager->reduceStock($product, 2);

        $this->assertEquals(8, $product->getStock());
    }

    public function testReduceStockWithInvalidQuantity(): void
    {
        $product = new Product();
        $product->setName('Laptop')->setPrice(1200)->setStock(10);

        $manager = new StockManager();

        $this->expectException(\InvalidArgumentException::class);
        $manager->reduceStock($product, 15); // Trop de stock à réduire
    }
}
```
Vous devez implémenter la classe `StockManager` pour que les tests passent.