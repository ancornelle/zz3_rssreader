<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 16:57
 */

class Entry {

    /*
     * String
     * guid or id
     */
    public $entryId;

    public $title;

    public $feed;

    /*
     * String
     * Description or Summary + Content
     */
    public $content;

    /*
     * String
     * link
     */
    public $url;

    /*
     * Date
     * PubDate or Updated
     */
    public $updatedDate;


}