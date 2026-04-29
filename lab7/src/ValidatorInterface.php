<?php
/**
 * Interface for data validators.
 */
interface ValidatorInterface
{
    /**
     * Validate title field.
     *
     * @param string $title Recipe title.
     * @return string|null Error message or null if valid.
     */
    public function validateTitle(string $title): ?string;

    /**
     * Validate category field.
     *
     * @param string $category Recipe category.
     * @return string|null Error message or null if valid.
     */
    public function validateCategory(string $category): ?string;

    /**
     * Validate date field.
     *
     * @param string $date Date in YYYY-MM-DD format.
     * @return string|null Error message or null if valid.
     */
    public function validateDate(string $date): ?string;

    /**
     * Validate ingredients field.
     *
     * @param string $ingredients Ingredients text.
     * @return string|null Error message or null if valid.
     */
    public function validateIngredients(string $ingredients): ?string;

    /**
     * Validate instructions field.
     *
     * @param string $instructions Cooking instructions.
     * @return string|null Error message or null if valid.
     */
    public function validateInstructions(string $instructions): ?string;

    /**
     * Validate provided data array.
     *
     * @param array $data Associative input data.
     * @return array Array of errors: field => message. Empty if valid.
     */
    public function validate(array $data): array;
}
