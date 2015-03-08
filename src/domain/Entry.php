<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 16:57
 */

class Entry {

    const tableName = 'entry';
    /*
     * String
     * guid or id
     */
    public $entryId = null;

    public $entryTitle;

    public $entryFeed;

    public $entryCategory;

    /*
     * String
     * Description or Summary + Content
     */
    public $entryContent;

    /*
     * String
     * link
     */
    public $entryUrl;

    /*
     * Date
     * PubDate or Updated
     */
    public $entryUpdatedDate;

    public function save(PDO $pCon)
    {
        if ($this->isNew($pCon))
        {
            $stmt = $pCon->prepare('INSERT INTO '.self::tableName.' (entryId, entryTitle, entryFeed, entryContent, entryUrl, entryUpdatedDate, entryCategory) VALUES (:id,:title,:feed,:content,:url,:date,:category)');
            $stmt->bindValue('id',$this->entryId);
            $stmt->bindValue('title',$this->entryTitle);
            $stmt->bindValue('content',$this->entryContent);
            $stmt->bindValue('feed',$this->entryFeed);
            $stmt->bindValue('category',$this->entryCategory);
            $stmt->bindValue('url',$this->entryUrl);
            $stmt->bindValue('date',$this->entryUpdatedDate);
        }
        else
        {
            $stmt = $pCon->prepare('UPDATE '.self::tableName.' SET entryTitle = :title, entryContent = :content, entryFeed = :feed, entryUrl = :url, entryUpdatedDate = :date, entryCategory = :category WHERE entryId = :id');
            $stmt->bindValue('id',$this->entryId);
            $stmt->bindValue('title',$this->entryTitle);
            $stmt->bindValue('content',$this->entryContent);
            $stmt->bindValue('feed',$this->entryFeed);
            $stmt->bindValue('category',$this->entryCategory);
            $stmt->bindValue('url',$this->entryUrl);
            $stmt->bindValue('date',$this->entryUpdatedDate);
        }
        return $stmt->execute();
    }

    public function delete(PDO $pCon)
    {
        $stmt = $pCon->prepare('DELETE FROM '.self::tableName.' WHERE entryId = :id');
        $stmt->bindValue('id',$this->entryId);
        $stmt->execute();
    }

    public function isNew($pCon)
    {
        $stmt = $pCon->prepare('SELECT entryId FROM '.self::tableName.' WHERE entryId = :id');
        $stmt->bindValue('id',$this->entryId);
        $stmt->execute();
        return [] === $stmt->fetchAll();
    }

    public function findAll($pCon)
    {
        $stmt = $pCon->prepare('SELECT * FROM '.self::tableName.' LIMIT 10');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllByFeedId($pCon, $pFeedId)
    {
        $stmt = $pCon->prepare('SELECT * FROM '.self::tableName.' WHERE entryFeed = :feed LIMIT 10');
        $stmt->bindValue('feed',$pFeedId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllByCategory($pCon, $pCategory)
    {
        $stmt = $pCon->prepare('SELECT * FROM '.self::tableName.' WHERE entryCategory = :category LIMIT 10');
        $stmt->bindValue('category',$pCategory);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllCategory($pCon)
    {
        $stmt = $pCon->prepare('SELECT DISTINCT entryCategory FROM '.self::tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}