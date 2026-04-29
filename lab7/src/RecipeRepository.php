<?php
/**
 * RecipeRepository handles JSONL storage operations for recipes.
 */
class RecipeRepository
{
    /**
     * Path to the JSONL storage file.
     */
    private string $filePath;

    /**
     * Constructor.
     *
     * @param string $filePath Path to JSONL file (defaults to data/recipes.jsonl).
     */
    public function __construct(string $filePath = __DIR__ . '/../data/recipes.jsonl')
    {
        $this->filePath = $filePath;
        $this->ensureStorageExists();
    }

    /**
     * Ensure data directory and file exist.
     *
     * @return void
     */
    private function ensureStorageExists(): void
    {
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    /**
     * Add a new recipe to storage.
     *
     * @param array $recipe Recipe data.
     * @return bool True on success.
     */
    public function add(array $recipe): bool
    {
        $line = json_encode($recipe, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return file_put_contents($this->filePath, $line . PHP_EOL, FILE_APPEND | LOCK_EX) !== false;
    }

    /**
     * Get all recipes from storage.
     *
     * @return array Array of recipe arrays.
     */
    public function getAll(): array
    {
        if (!is_file($this->filePath)) {
            return [];
        }

        $recipes = [];
        $fh = fopen($this->filePath, 'r');
        while (($line = fgets($fh)) !== false) {
            $obj = json_decode(trim($line), true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($obj)) {
                $recipes[] = $obj;
            }
        }
        fclose($fh);

        return $recipes;
    }

    /**
     * Sort recipes by a field.
     *
     * @param array $recipes Recipes to sort.
     * @param string $sortBy Field name to sort by.
     * @param string $order 'asc' or 'desc'.
     * @return array Sorted recipes.
     */
    public function sort(array $recipes, string $sortBy, string $order = 'asc'): array
    {
        usort($recipes, function($a, $b) use ($sortBy, $order) {
            $va = $a[$sortBy] ?? '';
            $vb = $b[$sortBy] ?? '';

            // For date-like fields, compare timestamps
            if (in_array($sortBy, ['date', 'created_at'], true)) {
                $ta = strtotime((string)$va) ?: 0;
                $tb = strtotime((string)$vb) ?: 0;
                if ($ta === $tb) return 0;
                return ($order === 'asc') ? ($ta < $tb ? -1 : 1) : ($ta > $tb ? -1 : 1);
            }

            if ($va == $vb) return 0;
            return ($order === 'asc') ? (($va < $vb) ? -1 : 1) : (($va > $vb) ? -1 : 1);
        });

        return $recipes;
    }
}
