<?php

class PostTagger {
    /** @var PostTag[] */
    private array $tags = [];

    public function addTag(PostTag $tag): void {
        $this->tags[] = $tag;
    }

    public function addTags(array $tags): void {
        foreach ($tags as $tag) {
            if ($tag instanceof PostTag) {
                $this->addTag($tag);
            }
        }
    }

    public function getTags(): array {
        return array_unique($this->tags, SORT_REGULAR);
    }

    public function getTagsString(string $separator = ', '): string {
        $names = array_map(fn($tag) => $tag->value, $this->getTags());
        return implode($separator, $names);
    }

    public function hasTag(PostTag $tag): bool {
        return in_array($tag, $this->getTags(), true);
    }
}