<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 16:57
 */

class Entry {

    const tableName = entry;
    /*
     * String
     * guid or id
     */
    public $entryId;

    public $entryTitle;

    public $entryFeed;

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

    public function save(Connection $pCon)
    {
        if ($this->isNew())
        {
            $stmt = $pCon->prepare('INSERT INTO '.self::tableName.' VALUES (:id,:title,:feed,:content,:url,:date)');
            $stmt->bindValues(':id',$this->entryId);
            $stmt->bindValues(':title',$this->entryTitle);
            $stmt->bindValues(':content',$this->entryContent);
            $stmt->bindValues(':feed',$this->entryFeed);
            $stmt->bindValues(':url',$this->entryUrl);
            $stmt->bindValues(':date',$this->entryUpdatedDate);
        }
        else
        {
            $stmt = $pCon->prepare('UPDATE '.self::tableName.' SET entryTitle = :title, entryContent = :content, entryFeed = :feed, entryUrl = :url, entryUpdatedDate = :date WHERE entryId = :id');
            $stmt->bindValues(':id',$this->entryId);
            $stmt->bindValues(':title',$this->entryTitle);
            $stmt->bindValues(':content',$this->entryContent);
            $stmt->bindValues(':feed',$this->entryFeed);
            $stmt->bindValues(':url',$this->entryUrl);
            $stmt->bindValues(':date',$this->entryUpdatedDate);
        }
        $stmt->execute();
    }

    public function delete(Connection $pCon)
    {
        $stmt = $pCon->prepare('DELETE FROM '.self::tableName.' WHERE entryId = :id');
        $stmt->bindValue(':id',$this->entryId);
    }

    public function isNew()
    {
        return null === $this->entryId;
    }

    public function findAll($pCon)
    {
        $stmt = $pCon->prepare('SELECT * FROM '.self::tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllByFeedId($pCon, $pFeedId)
    {
        $stmt = $pCon->prepare('SELECT * FROM '.self::tableName.' WHERE entryFeed = :feed');
        $stmt->bindValue(':feed',$pFeedId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}