<?php

namespace Blog\Entity;

class ArticleEntity
{
    protected $article_id;
    protected $article_title;
    protected $article_description;

    public function getID()
    {
        return $this->article_id;
    }

    public function getTitle()
    {
        return $this->article_title;
    }
    public function setTitle($title)
    {
        $this->article_title = $title;
    }

    public function getContent()
    {
        return $this->article_description;
    }
    public function setContent($description)
    {
        $this->article_description = $description;
    }

    public function getUrl()
    {
        return '/'.$this->getID();
    }
}
