<?php
require_once __DIR__ . '/ValidatorInterface.php';

/**
 * Basic implementation of ValidatorInterface for recipe data.
 */
class Validator implements ValidatorInterface
{
    /**
     * Allowed recipe categories.
     */
    private const ALLOWED_CATEGORIES = ['', 'breakfast', 'lunch', 'dinner', 'dessert'];

    /**
     * Validate title field.
     *
     * @param string $title Recipe title.
     * @return string|null Error message or null if valid.
     */
    public function validateTitle(string $title): ?string
    {
        $title = trim($title);
        if ($title === '') {
            return 'Название обязательно.';
        } elseif (mb_strlen($title) < 2) {
            return 'Название слишком короткое.';
        } elseif (mb_strlen($title) > 100) {
            return 'Название слишком длинное.';
        }

        return null;
    }

    /**
     * Validate category field.
     *
     * @param string $category Recipe category.
     * @return string|null Error message or null if valid.
     */
    public function validateCategory(string $category): ?string
    {
        $category = trim($category);
        if ($category !== '' && !in_array($category, self::ALLOWED_CATEGORIES, true)) {
            return 'Выбрана некорректная категория.';
        }

        return null;
    }

    /**
     * Validate date field.
     *
     * @param string $date Date in YYYY-MM-DD format.
     * @return string|null Error message or null if valid.
     */
    public function validateDate(string $date): ?string
    {
        $date = trim($date);
        if ($date === '') {
            return 'Дата обязательна.';
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return 'Дата должна быть в формате YYYY-MM-DD.';
        } else {
            $parts = explode('-', $date);
            if (!checkdate((int)$parts[1], (int)$parts[2], (int)$parts[0])) {
                return 'Неверная дата.';
            }
        }

        return null;
    }

    /**
     * Validate ingredients field.
     *
     * @param string $ingredients Ingredients text.
     * @return string|null Error message or null if valid.
     */
    public function validateIngredients(string $ingredients): ?string
    {
        $ingredients = trim($ingredients);
        if ($ingredients === '') {
            return 'Ингредиенты обязательны.';
        } elseif (mb_strlen($ingredients) < 5) {
            return 'Ингредиенты слишком короткие.';
        }

        return null;
    }

    /**
     * Validate instructions field.
     *
     * @param string $instructions Cooking instructions.
     * @return string|null Error message or null if valid.
     */
    public function validateInstructions(string $instructions): ?string
    {
        $instructions = trim($instructions);
        if ($instructions === '') {
            return 'Инструкция обязательна.';
        } elseif (mb_strlen($instructions) < 10) {
            return 'Инструкция слишком короткая.';
        }

        return null;
    }

    /**
     * Validate provided data array.
     *
     * @param array $data Associative input data.
     * @return array Array of errors: field => message. Empty if valid.
     */
    public function validate(array $data): array
    {
        $errors = [];

        $titleError = $this->validateTitle((string)($data['title'] ?? ''));
        if ($titleError !== null) {
            $errors['title'] = $titleError;
        }

        $categoryError = $this->validateCategory((string)($data['category'] ?? ''));
        if ($categoryError !== null) {
            $errors['category'] = $categoryError;
        }

        $dateError = $this->validateDate((string)($data['date'] ?? ''));
        if ($dateError !== null) {
            $errors['date'] = $dateError;
        }

        $ingredientsError = $this->validateIngredients((string)($data['ingredients'] ?? ''));
        if ($ingredientsError !== null) {
            $errors['ingredients'] = $ingredientsError;
        }

        $instructionsError = $this->validateInstructions((string)($data['instructions'] ?? ''));
        if ($instructionsError !== null) {
            $errors['instructions'] = $instructionsError;
        }

        return $errors;
    }
}
