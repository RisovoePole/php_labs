<?php

enum postHeaders: int{
    case ID = 0;
    case TITLE = 1;
    case AUTHOR = 2;
    case TAGS = 3;
    case BODY = 4;
    case LIKES = 5;
    case DISLIKES = 6;
    case CREATEDAT = 7;
}


/*
$fruits = ['apple', 'banana', 'orange'];
echo implode(", ", $fruits); 
// Output: apple, banana, orange
*/
class postsManager implements DBManager
{
    const string fileName = 'posts.csv';

    private static int $lastID = 0;

    private function openAndSkipHeaders(): ?\SplFileObject{
        $file = new \SplFileObject(self::fileName, 'r');
        $file->setFlags(\SplFileObject::READ_CSV);
        $file->setCsvControl(self::columnDelimiter);
        $file->fgetcsv(); // пропустить заголовок

        return $file;
    }

    private function formatRowString(array $data): array{
        $tagArray = explode(self::arrayDelimiter, $data[3]);

        $dateTimeObj = DateTime::createFromFormat(Post::$DateTimeFormatString, $data[7]);

        return [
            (int)$data[0],
            $data[1],
            $data[2],
            $tagArray,
            $data[4],
            (int)$data[5],
            (int)$data[6],
            $dateTimeObj
        ];
    }

    public function findById(int $id): ?object{
        $file = $this->openAndSkipHeaders();

        foreach ($file as $row) {
            if ($row === [null]) {
                continue;
            }

            if ((int)$row[0] === $id) {
                
                return new Post(
                    ...$this->formatRowString($row)
                );
            }
        }

        return null;
    }

    public function findByKey(string $key, mixed $value): array{
        $file = $this->openAndSkipHeaders();

        $index =  postHeaders::tryFrom(strtoupper($key));

        if(!$index){
            return [];
        }
        
        if($index === postHeaders::CREATED_AT && $value instanceof DateTime){
            $value = $value->format(post::$DateTimeFormatString);
        }

        $result = [];
        foreach ($file as $row) {
            if ($row === [null]) {
                continue;
            }

            if ((string) $row[$index->value] === (string)$value) {
                $result[] = new Post(
                    ...$this->formatRowString($row)
                );
            }
        }
        return $result;
    }

    public function findByKeys(array $filters): array{
        $file = $this->openAndSkipHeaders();

        if (!$filters or !array_keys($filters)) {
            return [];
        }

        $filters = array_unique($filters, SORT_REGULAR);

        $indexes = [];
        $values = [];
        foreach(array_keys($filters) as $key){
            $index = postHeaders::tryFrom(strtoupper($key));
            
            if(!$index || in_array($index, $indexes)){
                // unset($filters[$key]);
                continue;
            }

            $indexes[] = $index;
            $values[] = $filters[$key];
        }

        if(!$indexes){
            return [];
        }

        foreach ($indexes as $i => $index) {
            $value = $values[$i];

            if($index === postHeaders::CREATEDAT && $value instanceof DateTime){
                $values[$i] = $value->format(post::$DateTimeFormatString);
            }
        }
        
        $result = [];
        foreach ($file as $row) {
            if ($row === [null]) {
                continue;
            }

            if ((string) $row[$index->value] === (string)$value) {
                $result[] = new Post(
                    ...$this->formatRowString($row)
                );
            }
        }
        return $result;
    }

    public function findAll(): array;

    public function add(object $object): bool;
    public function update(int $id, object $object): bool;

    public function remove(int $id): bool;

    public function count(): int;

    public function truncate(): bool;
    public function export(string $filename): bool;
    public function import(string $filename): int;
    public function getFilePath(): string;
}
