<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 16:57
 */

class Feed {

    const tableName = 'feed';

    public $feedId;

    public $feedTitle;

    /*
     * String
     * SubTitle or Description
     */
    public $feedDescription;

    public $feedUrl;

    /*
     * Date
     * PubDate or Updated
     */
    public $feedUpdatedDate;

    /**
     * String
     * RSS or Atom feed
     */
    public $feedType;

    public function save(PDO $pCon)
    {
        if ($this->isNew($pCon))
        {
            $stmt = $pCon->prepare('INSERT INTO '.self::tableName.' (feedId, feedTitle, feedDescription, feedUrl, feedUpdatedDate, feedType) VALUES (:id,:title,:description,:url,:date,:type)');
            $stmt->bindValue('id',$this->feedId,PDO::PARAM_STR);
            $stmt->bindValue('title',$this->feedTitle,PDO::PARAM_STR);
            $stmt->bindValue('description',$this->feedDescription,PDO::PARAM_STR);
            $stmt->bindValue('url',$this->feedUrl,PDO::PARAM_STR);
            $stmt->bindValue('date',$this->feedUpdatedDate,PDO::PARAM_STR);
            $stmt->bindValue('type',$this->feedType,PDO::PARAM_STR);
        }
        else
        {
            $stmt = $pCon->prepare('UPDATE '.self::tableName.' SET feedTitle = :title, feedDescription = :description, feedUrl = :url, feedUpdatedDate = :date, feedType = :type WHERE feedId = :id');
            $stmt->bindValue('id',$this->feedId);
            $stmt->bindValue('title',$this->feedTitle);
            $stmt->bindValue('description',$this->feedDescription);
            $stmt->bindValue('url',$this->feedUrl);
            $stmt->bindValue('date',$this->feedUpdatedDate);
            $stmt->bindValue('type',$this->feedType,PDO::PARAM_STR);
        }
        return $stmt->execute();
    }

    public function delete(PDO $pCon)
    {
        $stmt = $pCon->prepare('DELETE FROM '.self::tableName.' WHERE feedId = :id');
        $stmt->bindValue(':id',$this->feedId);
        $stmt->execute();
    }

    public function isNew($pCon)
    {
        $stmt = $pCon->prepare('SELECT feedId FROM '.self::tableName.' WHERE feedId = :id');
        $stmt->bindValue(':id',$this->feedId);
        $stmt->execute();
        return [] === $stmt->fetchAll();
    }

    public function findAll($pCon)
    {
        $stmt = $pCon->prepare('SELECT * FROM '.self::tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}