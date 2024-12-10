<?php

class VendingMachine
{
    private $items = [
        "A" => 5000,
        "B" => 7000,
        "C" => 3000
    ];
    private $coinsInserted = 0;

    public function isItemAvailable($item)
    {
        return array_key_exists($item, $this->items) && $this->items[$item] > 0;
    }

    public function insertCoin($mount)
    {
        return $this->coinsInserted += $mount;
    }

    public function dispenseItem($itemName)
    {
        if ($this->isItemAvailable($itemName)) {
            if ($this->coinsInserted >= $this->items[$itemName]) {
                $this->coinsInserted -= $this->items[$itemName];
                return [
                    'itemName'  => $itemName,
                    'price'     => $this->items[$itemName],
                    'change'    => $this->coinsInserted
                ];
            } else {
                echo 'Not enough coins.';
            }
        }
    }
}

$vendingMachine = new VendingMachine();
echo 'Insert your coin:';
$amount = trim(fgets(fopen("php://stdin", "r")));
$vendingMachine->insertCoin($amount);
echo 'choose your item:';
$itemName = trim(fgets(fopen("php://stdin", "r")));
$result = $vendingMachine->dispenseItem($itemName);
if (is_array($result)) {
    echo 'Your item is ' . $result['itemName'] . ' and change: ' . $result['change'] . ' coin.';
}
