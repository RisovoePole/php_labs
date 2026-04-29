<?php

class Post {
    public function __construct(
        private int $id,
        private string $uuid,
        private string $name,
        private int $age,
        private string $desc
    )
    {}

    public function getID(): int{
        return $this->id;
    }

    public function getUUID(): string{
        return $this->uuid;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getAge(): int{
        return $this->age;
    }

    public function getDesc(): string{
        return $this->desc;
    }

    public function setName(string $name): void{
        $this->name = $name;
    }

    public function setAge(string $age): void{
        $this->age = $age;
    }

     public function setDesc(string $desc): void{
        $this->desc = $desc;
    }
}