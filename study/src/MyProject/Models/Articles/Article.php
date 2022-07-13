<?php

namespace MyProject\Models\Articles;
use MyProject\Models\Users\User;
use MyProject\Models\ActiveRecordEntity;

class Article extends ActiveRecordEntity
{
    protected $name;
    protected $text;
    protected $authorId;
    protected $createdAt;

    public function getName(): string{
        return $this->name;
    }

    public function getText(): string{
        return $this->text;
    }

    public function getAuthor(): User{
        return User::getById($this->authorId);
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setText(string $text){
        $this->text = $text;
    }

    public function setAuthor(User $authorId){
        $this->authorId = $authorId; 
    }

    protected static function getTableName(): string {
        return 'articles';
    }

    public static function createFromArray(array $fields): Article{
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $article = new Article();
        $article->setName($fields['name']);
        $article->setText($fields['text']);

        $article->save();

        return $article;
    }

    public function updateFromArray(array $fields): Article{
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }
        $this->setName($fields['name']);
        $this->setText($fields['text']);
        $this->save();
        return $this;
    }
}