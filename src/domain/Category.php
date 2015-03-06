<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 16:56
 */

class Category {

    const tableName = 'category';

    public $categoryId;

    public $categoryName;

    public $feeds = array();

    public function save(PDO $pCon)
    {
        if ($this->isNew())
        {
            $stmt = $pCon->prepare('INSERT INTO '.self::tableName.' VALUES (:name)');
            $stmt->bindValue(':name',$this->categoryName);
        }
        else
        {
            $stmt = $pCon->prepare('UPDATE '.self::tableName.' SET categoryName = :name WHERE categoryId = :id');
            $stmt->bindValue(':name',$this->categoryName);
            $stmt->bindValue(':id',$this->categoryId);
        }
        $stmt->execute();
    }

    public function delete(PDO $pCon)
    {
        $stmt = $pCon->prepare('DELETE FROM '.self::tableName.' WHERE categoryId = :id');
        $stmt->bindValue(':id',$this->categoryId);
        $stmt->execute();
    }

    public function isNew()
    {
        return null === $this->categoryId;
    }

    public function findAll($pCon)
    {
        $stmt = $pCon->prepare('SELECT * FROM '.self::tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}