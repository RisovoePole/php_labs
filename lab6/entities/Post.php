<?php

use Dom\Text;

class Post {
    public static string $DateTimeFormatString = 'd-m-Y H:i';

    public function __construct(
        private int $id,
        private string $title,
        private string $author,
        private array $tags,
        private Text $body,
        private int $likes,
        private int $dislikes,
        private DateTime $createdAt
    )
    {}
     

    public function getID(): int{
        return $this->id;
    }

    public function getTitle(): string{
        return $this->title;
    }

    public function getAuthor(): string{
        return $this->author;
    }

    public function getTags(): array{
        return $this->tags;
    }

    public function getBody(): Text{
        return $this->body;
    }

    public function getLikes(): int{
        return $this->likes;
    }

    public function getDislikes(): int{
        return $this->dislikes;
    }

    public function getCreatedAt(): DateTime{
        return $this->createdAt;
    }
    
    public function setTitle(string $title): void{
        $this->title = $title;
    }

    public function setAuthor(string $author): void{
        $this->author = $author;
    }

    public function setTags(array $tags): void{
        $this->tags = $tags;
    }

    public function setBody(Text $body): void{
        $this->body = $body;
    }


    public function setLikes(int $likes): void{
        $this->likes = $likes;
    }

    public function setDislikes(int $dislikes): void{
        $this->dislikes = $dislikes;
    }

    public function setCreateAt(DateTime $dateTime): void{
        $this->createdAt = $dateTime;
    }
}