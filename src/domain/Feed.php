<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 16:57
 */

class Feed {

    const tableName = feed;

    public $feedId;

    public $feedTitle;

    /*
     * String
     * SubTitle or Description
     */
    public $feedDescription;

    public $FeedUrl;

    public $FeedCategory;

    /*
     * Date
     * PubDate or Updated
     */
    public $feedUpdatedDate;

    public function save(Connection $pCon)
    {
        if ($this->isNew())
        {
            $stmt = $pCon->prepare('INSERT INTO '.self::tableName.' VALUES (:id,:title,:description,:url,:category,:date)');
            $stmt->bindValues(':id',$this->feedId);
            $stmt->bindValues(':title',$this->feedTitle);
            $stmt->bindValues(':description',$this->feedDescription);
            $stmt->bindValues(':category',$this->feedCategory);
            $stmt->bindValues(':url',$this->feedUrl);
            $stmt->bindValues(':date',$this->feedUpdatedDate);
        }
        else
        {
            $stmt = $pCon->prepare('UPDATE '.self::tableName.' SET feedTitle = :title, feedDescription = :description, feedCategory = :category, feedUrl = :url, feedUpdatedDate = :date WHERE feedId = :id');
            $stmt->bindValues(':id',$this->feedId);
            $stmt->bindValues(':title',$this->feedTitle);
            $stmt->bindValues(':description',$this->feedDescription);
            $stmt->bindValues(':category',$this->feedCategory);
            $stmt->bindValues(':url',$this->feedUrl);
            $stmt->bindValues(':date',$this->feedUpdatedDate);
        }
        $stmt->execute();
    }

    public function delete(Connection $pCon)
    {
        $stmt = $pCon->prepare('DELETE FROM '.self::tableName.' WHERE feedId = :id');
        $stmt->bindValue(':id',$this->feedId);
    }

    public function isNew()
    {
        return null === $this->feedId;
    }

    public function findAll($pCon)
    {
        $stmt = $pCon->prepare('SELECT * FROM '.self::tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllByCategoryId($pCon, $pCategoryId)
    {
        $stmt = $pCon->prepare('SELECT * FROM '.self::tableName.' WHERE feedCategory = :category');
        $stmt->bindValue(':category',$pCategoryId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}