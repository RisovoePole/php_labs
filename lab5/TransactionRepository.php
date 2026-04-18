<?php

declare(strict_types=1);

class TransactionRepository implements TransactionStorageInterface {
    /** @var Transaction[] */
    private array $transactionList = [];

    /**
     * Finds a transaction by ID.
     */
    public function findById(int $id): ?Transaction{
        foreach ($this->transactionList as $transaction) {
            if ($transaction->getId() === $id) {
                return $transaction;
            }
        }

        return null;
    }

    /**
     * Returns all transactions.
     *
     * @return Transaction[]
     */
    public function getAllTransactions(): array {
        return $this->transactionList;
    }

    /**
     * Adds a transaction to repository.
     */
    public function addTransaction(Transaction $transaction): void {
        array_push($this->transactionList, $transaction);
    }

    /**
     * Removes transaction by ID if present.
     */
    public function removeTransactionById(int $id): void {
        foreach ($this->transactionList as $index => $transaction) {
            if ($transaction->getId() === $id) {
                unset($this->transactionList[$index]);
                $this->transactionList = array_values($this->transactionList);
                return;
            }
        }
    }
}   