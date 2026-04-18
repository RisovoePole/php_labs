<?php

declare(strict_types=1);

class Transaction
{
    /**
     * @param int $id Unique transaction ID.
     * @param DateTime $date Transaction date and time.
     * @param float $amount Transaction amount.
     * @param string $description Transaction description.
     * @param string $merchant Merchant name.
     */
    public function __construct(
        private int $id,
        private DateTime $date,
        private float $amount,
        private string $description,
        private string $merchant
    ) {}

    /**
     * Returns number of full days passed since transaction date.
     */
    public function getDaysSinceTransaction(): int {
        return (new DateTime()->diff($this->date))->days;
    }

    /** Returns transaction ID. */
    public function getId(): int
    {
        return $this->id;
    }

    /** Returns transaction date and time. */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /** Returns transaction amount. */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /** Returns transaction description. */
    public function getDescription(): string
    {
        return $this->description;
    }

    /** Returns merchant name. */
    public function getMerchant(): string
    {
        return $this->merchant;
    }
}
