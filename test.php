<?php

class VendingMachine
{
    private $totalMoneyInserted = 0;
    private $maxBill = 3;
    private $acceptableMoney = [
        2000,
        5000
    ];
    private $items = [
        [
            'name' => 'Aqua',
            'price' => 2000,
        ],
        [
            'name' => 'Sosro',
            'price' => 5000,
        ],
        [
            'name' => 'Cola',
            'price' => 7000,
        ],
        [
            'name' => 'Milo',
            'price' => 9000,
        ]
    ];

    public function insertMoney($money)
    {
        $countBill = 0;
        if (is_array($money)) {
            foreach ($money as $value) {
                if (in_array($value, $this->acceptableMoney) && $countBill < $this->maxBill) {
                    $this->totalMoneyInserted += $value;
                    $countBill++;
                }
            }
        }

        return $this->totalMoneyInserted > 0 ? true : false;
    }

    public function dispenseItem()
    {
        $keys = array_column($this->items, 'price');
        array_multisort($keys, SORT_DESC, $this->items);
        $minItemPrice = min(array_map(function ($item) {
            return $item['price'];
        }, $this->items));

        $combinations = array();
        do {
            foreach ($this->items as $item) {
                if ($this->totalMoneyInserted >= $item['price']) {
                    $key = array_search($item['name'], array_column($combinations, 'itemName'));
                    if ($key !== false) {
                        $combinations[$key]['quantity'] += 1;
                    } else {
                        $combinations[] = [
                            'quantity' => 1,
                            'itemName' => $item['name'],
                        ];
                    }
                    $this->totalMoneyInserted -= $item['price'];
                }
            }
        } while ($minItemPrice <= $this->totalMoneyInserted);

        return $combinations;
    }

    public function execute($money)
    {
        if ($this->insertMoney($money)) {
            $obtainedItems = $this->dispenseItem();
            if ($obtainedItems) {
                $output = '';
                foreach ($obtainedItems as $key => $obtainedItem) {
                    $output .= $obtainedItem['quantity'] . " " . $obtainedItem['itemName'];
                    if (count($obtainedItems) > 1 && $key != count($obtainedItems) - 1) {
                        $output .= ", ";
                    }
                }
                return $output;
            } else {
                return "No item is available";
            }
        } else {
            return "Invalid denomination";
        }
    }
}

$testCases = [
    [
        'name' => 'Test Case 1',
        'input' => [2000]
    ],
    [
        'name' => 'Test Case 2',
        'input' => [2000, 2000]
    ],
    [
        'name' => 'Test Case 3',
        'input' => [5000, 2000]
    ],
    [
        'name' => 'Test Case 4',
        'input' => [1000]
    ],
    [
        'name' => 'Test Case 5',
        'input' => [5000, 5000]
    ],
    [
        'name' => 'Test Case 6',
        'input' => [5000, 5000, 5000]
    ],
];

foreach ($testCases as $testCase) {
    echo "\n" . $testCase['name'] . ": ";

    $vendingMachine = new VendingMachine;
    echo $vendingMachine->execute($testCase['input']);
}
