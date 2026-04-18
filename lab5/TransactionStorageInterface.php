<?php

declare(strict_types=1);

interface TransactionStorageInterface {

    /**
     * Saves a transaction to storage.
     */
    public function addTransaction(Transaction $transaction): void;

    /**
     * Removes a transaction by ID if it exists.
     */
    public function removeTransactionById(int $id): void;

    /**
     * Returns all stored transactions.
     *
     * @return Transaction[]
     */
    public function getAllTransactions(): array;

    /**
     * Finds transaction by ID.
     */
    public function findById(int $id): ?Transaction;
}