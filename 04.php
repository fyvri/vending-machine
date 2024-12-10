<?php

class VendingMachine
{
    private $items = [
        1 => [
            'name' => 'Cola',
            'price' => 1500,
            'quantity' => 5
        ],
        2 => [
            'name' => 'Fanta',
            'price' => 1200,
            'quantity' => 5
        ],
        3 => [
            'name' => 'Sprite',
            'price' => 1500,
            'quantity' => 5
        ],
    ];
    private $coinInserted = 0;

    public function getItems()
    {
        return $this->items;
    }

    public function getItem($itemId)
    {
        return array_key_exists($itemId, $this->items) ? $this->items[$itemId] : null;
    }

    public function insertCoin($amount)
    {
        return $this->coinInserted += $amount;
    }

    public function dispenseItem($itemId)
    {
        $response = [
            'rc' => '00'
        ];

        $item = $this->getItem($itemId);
        if ($item) {
            if ($item['quantity'] > 0) {
                if ($item['price'] <= $this->coinInserted) {
                    $initialCoin = $this->coinInserted;
                    $this->coinInserted -= $item['price'];
                    $this->items[$itemId]['quantity']--;

                    $response['data'] = [
                        'item'  => $item,
                        'initialCoin' => $initialCoin,
                        'change' => $this->coinInserted
                    ];
                } else {
                    $response = [
                        'rc' => '61',
                        'message' => 'Coin not enough'
                    ];
                }
            } else {
                $response = [
                    'rc' => '13',
                    'message' => 'Quantity invalid'
                ];
            }
        } else {
            $response = [
                'rc' => '12',
                'message' => 'Transaction invalid'
            ];
        }

        return $response;
    }
}

$vendingMachine = new VendingMachine();
$result = $vendingMachine->dispenseItem(1, 500);
if ($result['rc'] == '00') {
    $item = $result['data']['item'];
    $initialCoin = $result['data']['initialCoin'];
    $currentCoin = $result['data']['change'];
    echo "\nYour item name: " . $item['name'];
    echo "\nYour initial coin: " . $initialCoin;
    echo "\nYour change: " . $currentCoin;
} else {
    echo "\n" . $result['message'];
}
