<?php

namespace Blog\Repository;

use Blog\Entity\ArticleEntity;
use PDO;

class ArticleRepository
{
    const ENTITY = '\Blog\Entity\ArticleEntity';

    protected $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function findAll($limit = 10, $offset = 0)
    {
        $query = $this->db->prepare('
            SELECT article_id, article_title
            FROM article
            ORDER BY article_id DESC
            LIMIT :limit
            OFFSET :offset
        ');
        $query->bindParam('limit', $limit, \PDO::PARAM_INT);
        $query->bindParam('offset', $offset, \PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_CLASS, static::ENTITY);
    }

    public function find($id)
    {
        $query = $this->db->prepare('
            SELECT article_id, article_title, article_description
            FROM article
            WHERE article_id = :id
        ');
        $query->bindParam('id', $id, \PDO::PARAM_INT);
        $query->execute();

        return $query->fetchObject(static::ENTITY);
    }

    public function save(ArticleEntity $article)
    {
        $query = $this->db->prepare('
            INSERT INTO article (article_title)
            VALUES (:title)'
        );
        $query->execute([
            'title' => $article->getTitle(),
        ]);

        return $this->db->lastInsertId();
    }
}
