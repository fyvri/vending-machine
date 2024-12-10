# Simple Vending Machine Logic Flows

This project simulates a simple beverage vending machine. It consists of `six PHP files`, each representing different logic flows to handle vending machine operations. The functionality includes selecting beverages, handling money input, and testing the vending machine.

## 📃 File Overview

1.  **[01.php](01.php)**

    This file defines the main vending machine functionality. It includes the following features:

    - Initialization: Sets up the initial stock and prices of beverages (`Cola`, `Fanta`, `Sprite`), along with initial revenue.
    - Insert Coin: Accepts coin input and updates the total inserted amount.
    - Buy Drink: Allows the purchase of a drink if sufficient coins have been inserted. Handles stock checking and provides change to the user if necessary. Updates stock and total revenue.
    - Stock Check: Provides the current stock of a specific beverage.
    - Revenue Check: Displays the total revenue collected by the vending machine.

    **Example Test Flow:**

    1. Insert a coin of 2000.
    2. Purchase a `Cola`.
    3. Outputs the purchased drink details, remaining stock, and updated revenue.

2.  **[02.php](02.php)**

    This file implements a vending machine's core functionalities, including coin insertion and item dispensing. It features:

    - Coin Insertion: Allows users to input coin values to accumulate a balance for purchasing items.
    - Item Availability Check: Validates if the selected item exists and is purchasable.
    - Dispense Item: Dispenses the selected item if sufficient coins are inserted. Returns the item's name, price, and any remaining balance as change.

    **Example Test Flow:**

    1. User inserts coins (e.g., 5000).
    2. User selects an item (e.g., `A`).
    3. If the balance is sufficient, the item is dispensed, and any remaining balance is returned as change.

3.  **[03.php](03.php)**

    This file expands the vending machine functionality by introducing enhanced item selection and purchasing logic. It includes:

    - Item Availability Check: Ensures the selected item exists and is in stock.
    - Coin Insertion and Validation: Accepts coin inputs, verifies they are numeric, and calculates the total inserted amount.
    - Item Purchasing: Dispenses the selected item if sufficient coins are inserted. Handles stock updates and calculates change.
    - Repeat Purchases: Allows users to continue purchasing items or exit the vending machine.
    - Coin Return: Ensures any remaining balance is cleared when the user exits.

    **Example Test Flow:**

    1. Display available items with prices and stock.
    2. User selects an item ID (e.g., 1 for `A`).
    3. User inserts coins (e.g., 7000).
    4. If sufficient, the item is dispensed, and the user receives their change.
    5. The user is prompted to make another purchase or exit.

4.  **[04.php](04.php)**

    This file models a vending machine with the following functionalities:

    - Item Management: Provides a list of available items (`Cola`, `Fanta`, `Sprite`) with prices, stock, and IDs.
    - Coin Insertion: Allows users to insert coins and accumulates the total amount.
    - Item Selection and Dispensing:
      - Verifies the validity of the selected item ID.
      - Ensures the selected item is in stock and the user has inserted sufficient coins.
      - Dispenses the item and calculates the change if the transaction is successful.
      - Updates the stock of the selected item.
    - Error Handling: Returns appropriate error messages for invalid transactions, insufficient funds, or out-of-stock items.

    **Example Output:**

    - Successful Transaction:
      ```
      Your item name: Cola
      Your initial coin: 2000
      Your change: 500
      ```
    - Error Messages:
      - `Coin not enough`
      - `Transaction invalid`
      - `Quantity invalid`

5.  **[05.php](05.php)**

    This file introduces a more interactive flow for the vending machine, allowing users to select items and perform transactions while handling various scenarios:

    - Item Selection: Retrieves and displays the list of available items with their prices and quantities.
    - Coin Insertion: Enables users to insert coins and tracks the total amount.
    - Purchase Item: Checks the selected item ID, verifies sufficient funds, and processes the transaction.
      - Deducts the item's price from the inserted amount.
      - Dispenses the item if it's in stock and enough funds are provided.
      - Returns the remaining balance as change.
    - Error Handling:
      - Displays `Item not found` if an invalid item ID is entered.
      - Shows `Coin not enough` if the inserted amount is insufficient.
      - Displays `Quantity invalid` if the item is out of stock.

    **Example Usage**

    ```php
    $vendingMachine = new VendingMachine;
    $vendingMachine->insertCoin(15000);
    $result = $vendingMachine->buyItem(1);
    print_r($result);
    ```

    **Example Output:**

    - Successful Purchase:
      ```php
      [
          'rc' => '00',
          'message' => '',
          'data' => [
              'item' => [...],
              'change' => 7000
          ]
      ]
      ```
    - Errors:
      - `Item not found`
      - `Coin not enough`
      - `Quantity invalid`

6.  **[test.php](test.php)**

    This file demonstrates how to calculate and dispense beverages based on user inputs in the form of currency bills. It includes:

    **Key Test Scenarios:**

    - Coin Validation:
      - Ensures that only valid coin denominations (2000, 5000) are accepted.
      - Verifies that invalid inputs, such as unsupported denominations or non-numeric values, are rejected.
      - Maximum of 3 bills can be inputted.
    - Beverage Selection:
      - Dispenses the maximum number of beverages based on the total money inserted.
      - Prioritizes higher-priced beverages when possible.
      - Beverages and Prices:
        - Aqua: 2000
        - Sosro: 5000
        - Cola: 7000
        - Milo: 9000
    - Functionality:
      - Validates the input money to ensure they are within acceptable denominations and quantity.
      - Dispenses beverages based on the total amount inserted and their prices, returning combinations of beverages.

    **Example Usage**

    ```php
    $vendingMachine = new VendingMachine;
    echo $vendingMachine->execute([2000, 2000]);
    ```

    **Example Test Cases**

    | Input                | Output               |
    | -------------------- | -------------------- |
    | `[2000]`             | 1 Aqua               |
    | `[2000, 2000]`       | 2 Aqua               |
    | `[5000, 2000]`       | 1 Cola               |
    | `[1000]`             | Invalid denomination |
    | `[5000, 5000]`       | 1 Milo               |
    | `[5000, 5000, 5000]` | 1 Milo, 1 Sosro      |

## 🛠️ How to Run the Project

1.  Clone this repository to your local machine.
    - Using SSH URL
      ```bash
      $ git clone git@github.com:fyvri/vending-machine.git
      ```
    - Using HTTPS URL
      ```bash
      $ git clone https://github.com/fyvri/vending-machine.git
      ```
2.  Ensure you have PHP installed.
3.  Run each file using the following command:
    ```bash
    php <filename>.php
    ```

## 👥 Contributions

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Please [open an issue](https://github.com/fyvri/vending-machine/issues/new) or submit a pull request if you have ideas to improve the project. Any contributions you make are **greatly appreciated 🌟**

## 📜 License

This project is licensed under [the MIT License](./LICENSE). Feel free to use and modify it as needed.
