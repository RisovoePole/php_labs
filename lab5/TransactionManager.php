<?php

declare(strict_types=1);

class TransactionManager
{

    /**
     * @param TransactionStorageInterface $repository Source of transactions.
     */
    public function __construct(
        private TransactionStorageInterface $repository
    ) {}

    /**
     * Calculates total amount for all transactions.
     */
    public function calculateTotalAmount(): float
    {
        return array_reduce(
            $this->repository->getAllTransactions(),
            fn($acc, $t) => $acc += $t->getAmount(),
            0.0
        );
    }

    /**
     * Calculates total amount for transactions in inclusive date range.
     */
    public function calculateTotalAmountByDateRange(string $startDate, string $endDate): float
    {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);

        return array_reduce(
            $this->repository->getAllTransactions(),
            function ($acc, $t) use ($start, $end) {
                $date = $t->getDate();

                if ($date >= $start && $date <= $end) {
                    $acc += $t->getAmount();
                }

                return $acc;
            },
            0.0
        );
    }

    /**
     * Counts transactions for exact merchant name match.
     */
    public function countTransactionsByMerchant(string $merchant): int
    {
        return array_reduce(
            $this->repository->getAllTransactions(),
            fn($acc, $t) => $t->getMerchant() === $merchant ? $acc += 1 : $acc,
            0
        );
    }

    /**
     * Sorts transactions by date.
     *
     * @return Transaction[]
     */
    public function sortTransactionsByDate(bool $newFirst = true): array
    {
        $newArray = $this->repository->getAllTransactions();

        $cond = fn($a, $b) => $newFirst ? $b <=> $a : $a <=> $b;

        usort($newArray, fn($a, $b) => $cond($a->getDate(), $b->getDate()));
        
        return $newArray;
    }

    /**
     * Sorts transactions by amount in descending order.
     *
     * @return Transaction[]
     */
    public function sortTransactionsByAmountDesc(): array
    {
        $newArray = $this->repository->getAllTransactions();

        usort($newArray, fn($a, $b) => $b->getAmount() <=> $a->getAmount());

        return $newArray;
    }
}
