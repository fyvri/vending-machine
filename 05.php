<?php

class VendingMachine
{
    private $items = [
        1 => [
            'name' => 'Pepsi',
            'price' => 8000,
            'quantity' => 5
        ],
        2 => [
            'name' => 'Coca Cola',
            'price' => 7000,
            'quantity' => 10
        ],
        3 => [
            'name' => 'Fanta',
            'price' => 1000,
            'quantity' => 8
        ]
    ];
    private $coinInserted = 0;

    public function getItem($itemId)
    {
        return array_key_exists($itemId, $this->items) ? $this->items[$itemId] : null;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function insertCoin($amount)
    {
        $this->coinInserted += $amount;
    }

    public function buyItem($itemId)
    {
        $response = [
            'rc' => '00',
            'message' => '',
            'data' => []
        ];
        $item = $this->getItem($itemId);
        if ($item) {
            if ($item['quantity'] > 0) {
                if ($this->coinInserted >= $item['price']) {
                    $this->coinInserted -= $item['price'];
                    $item['quantity']--;

                    $response['data'] = [
                        'item' => $item,
                        'change' => $this->coinInserted
                    ];
                } else {
                    $response['rc'] = '61';
                    $response['message'] = 'Coin not enough';
                }
            } else {
                $response['rc'] = '13';
                $response['message'] = 'Quantity invalid';
            }
        } else {
            $response['rc'] = '12';
            $response['message'] = 'Item not found';
        }

        return $response;
    }
}

$vendingMachine = new VendingMachine;
$vendingMachine->insertCoin(15000);
$result = $vendingMachine->buyItem(1);
print_r($result);
