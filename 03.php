<?php

class VendingMachine
{
    private $items = [
        1 => [
            'itemName' => 'A',
            'price' => 7000,
            'quantity' => 5
        ],
        2 => [
            'itemName' => 'B',
            'price' => 10000,
            'quantity' => 10
        ],
        3 => [
            'itemName' => 'C',
            'price' => 5000,
            'quantity' => 5
        ],
    ];

    private $coinInserted = 0;

    public function isItemAvailable($itemId)
    {
        return array_key_exists($itemId, $this->items) && $this->items[$itemId]['quantity'] > 0 ? true : false;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function insertCoin($amount)
    {
        $this->coinInserted += $amount;
    }

    public function getCoin()
    {
        return $this->coinInserted;
    }

    public function returnCoin()
    {
        $this->coinInserted = 0;
    }

    public function buyItem($itemId)
    {
        $item = $this->items[$itemId];
        if ($this->coinInserted >= $item['price']) {
            $this->coinInserted -= $item['price'];
            $this->items[$itemId]['quantity']--;
            return [
                'success' => true,
                'itemName' => $item['itemName'],
                'price' => $item['price'],
                'change' => $this->coinInserted,
            ];
        } else {
            return [
                'success' => false,
                'message' => "Coin not enough"
            ];
        }
    }
}

$vendingMachine = new VendingMachine();
$isBuyBack = true;
do {
    foreach ($vendingMachine->getItems() as $itemId => $item) {
        echo "\n" . $itemId . ". " . $item['itemName'];
        echo "\n   Price: " . $item['price'];
        echo "\n   Stock: " . $item['quantity'];
    }

    $stdin = "php://stdin";
    do {
        echo "\nChoose your item: ";
        $itemId = trim(fgets(fopen($stdin, "r")));
        $isItemAvailable = $vendingMachine->isItemAvailable($itemId);
        if (!$isItemAvailable) {
            echo "Item not available";
        }
    } while (!$isItemAvailable);

    do {
        echo "Insert your coin: ";
        $amount = trim(fgets(fopen($stdin, "r")));
        $isAmountNumeric = is_numeric($amount);
        if (!$isAmountNumeric) {
            echo "Your coin not supported in this machine";
        } else {
            $vendingMachine->insertCoin($amount);
            $result = $vendingMachine->buyItem($itemId);
            if ($result['success']) {
                echo "Your item is " . $result['itemName'] . " and change: " . $result['change'] . " coin.";

                echo "\nYour transaction successfully";
                echo "\nPress 'y' for buy back or press 'n' to exit: ";
                $isBuyBack = trim(fgets(fopen($stdin, "r"))) == 'y' ? true : false;
            } else {
                echo $result['message'];
                echo "\nPlease insert your coin matches amount. your coin: " . $vendingMachine->getCoin() . "\n";

                $isAmountNumeric = false;
            }
        }
    } while (!$isAmountNumeric);
} while ($isBuyBack);
$vendingMachine->returnCoin();
