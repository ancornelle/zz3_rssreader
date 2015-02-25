<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 16:57
 */

class Feed {
    public $url;

    public $title;

    /*
     * String
     * SubTitle or Description
     */
    public $description;

    /*
     * Date
     * PubDate or Updated
     */
    public $updatedDate;

    public $categories = array();
}