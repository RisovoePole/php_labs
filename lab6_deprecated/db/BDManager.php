<?php

interface DBManager {
    const columnDelimiter = ';';
    const arrayDelimiter = ',';

    public function findById(int $id):?object;

    public function findByKey(string $key, mixed $value): array;
    public function findByKeys(array $filters): array;
    public function findAll(): array;

    public function add(object $object): bool;
    public function update(int $id, object $object): bool;

    public function remove(int $id): bool;

    public function count(): int;

    public function truncate(): bool;                     
    public function export(string $filename): bool;             
    public function getFilePath(): string;
    
}