<?php
/**
 * Custom Twig filters for recipe templating.
 */
class TwigFilters
{
    /**
     * Add recipe category icon filter.
     *
     * Converts category name to display with emoji:
     * - breakfast → "🌅 Завтрак"
     * - lunch → "☀️ Обед"
     * - dinner → "🌙 Ужин"
     * - dessert → "🍰 Десерт"
     *
     * @param string $category Category name
     * @return string Formatted category with icon
     */
    public static function recipeCategoryIcon(string $category): string
    {
        $icons = [
            'breakfast' => '🌅 Завтрак',
            'lunch' => '☀️ Обед',
            'dinner' => '🌙 Ужин',
            'dessert' => '🍰 Десерт',
        ];

        return $icons[$category] ?? ucfirst($category);
    }
}
