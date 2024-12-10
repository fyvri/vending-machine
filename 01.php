<?php

class VendingMachine
{
    private $items = [
        'cola' => [
            'stock' => 10,
            'price' => 2000,
        ],
        'fanta' => [
            'stock' => 10,
            'price' => 2000,
        ],
        'sprite' => [
            'stock' => 10,
            'price' => 2000,
        ],
    ];

    private $coinInserted = 0;
    private $totalRevenue = 9000;

    public function insertCoin($amount)
    {
        $this->coinInserted += $amount;
    }

    public function buyDrink($drinkName)
    {
        if (array_key_exists($drinkName, $this->items)) {
            $item = $this->items[$drinkName];
            if ($item > 0) {
                if ($this->coinInserted >= $item['price']) {
                    $change = $this->coinInserted -= $item['price'];
                    $this->totalRevenue += $item['price'];
                    $this->items[$drinkName]['stock']--;

                    return [
                        'itemName' => $drinkName,
                        'price' => $item['price'],
                        'change' => $change,
                    ];
                } else {
                    echo "Not enough coins.";
                }
            } else {
                echo "Not enough stock.";
            }
        } else {
            echo "Item not found";
        }
    }

    public function getStock($drinkName)
    {
        if (array_key_exists($drinkName, $this->items)) {
            return $this->items[$drinkName]['stock'];
        } else {
            return 0;
        }
    }

    public function getRevenue()
    {
        return $this->totalRevenue;
    }
}

$vendingMachine = new VendingMachine();
$vendingMachine->insertCoin(2000);
$drinkName = 'cola';
$result = $vendingMachine->buyDrink('cola');
if (is_array($result)) {
    echo "Your drink: " . $result['itemName'] . ', price: ' . $result['price'] . ' and change: ' . $result['change'];

    echo ' - current ' . $result['itemName'] . ' stock: ' . $vendingMachine->getStock($drinkName);
    echo ' - current revenue: ' . $vendingMachine->getRevenue();
}
