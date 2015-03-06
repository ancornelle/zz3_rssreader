<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 17:28
 */

use ForceUTF8\Encoding;

require_once __DIR__.'/../domain/Feed.php';
require_once __DIR__.'/../domain/Entry.php';
require_once __DIR__.'/../domain/Connection.php';

/**
 * @param $pEntryUrl
 */
function parseRSSByEntry($pEntryUrl)
{
    $rssget_rss = new \Zelenin\RSSGet($pEntryUrl);
    $channel = $rssget_rss->getChannel();
    $feed = new Feed();
    $feed->feedId = $channel['title'];
    $feed->feedTitle = $channel['title'];
    $feed->feedUrl = $channel['link'];
    $feed->feedUpdatedDate = $channel['pubDate'];
    array_key_exists('description',$channel) ? $feed->feedDescription = $channel['description'] : $feed->feedDescription = '';
    $feed->feedCategory = 1;
    $feed->save(Connection::getPDO());

    $items = $rssget_rss->getItems();
    // Le monde est très mal encodé...
    $items = Encoding::toWin1252($items);
    foreach ($items as $item)
    {
        $entry = new Entry();
        echo '<pre>';
        $entry->entryTitle = $item['title'];
        $entry->entryUrl = $item['link'];
        $entry->entryFeed = 0;
        $entry->entryId = $item['guid'];
        $entry->entryContent = $item['description'];
        $entry->entryUpdatedDate = $item['pubDate'];
        $entry->save(Connection::getPDO());
    }

}

function parseAtomByEntry($pEntryUrl)
{
    $rssget_atom = new \Zelenin\RSSGet($pEntryUrl);

    $channel = $rssget_atom->getChannel();
    $feed = new Feed();
    $feed->feedId = $channel['id'];
    $feed->feedTitle = $channel['title'];
    $feed->feedUrl = $channel['link_href'];
    $feed->feedUpdatedDate = $channel['updated'];
    array_key_exists('description',$channel) ? $feed->feedDescription = $channel['description'] : $feed->feedDescription = '';
    $feed->feedCategory = 1;
    $feed->save(Connection::getPDO());

    $items = $rssget_atom->getItems();
    foreach ($items as $item)
    {
        $entry = new Entry();
        $entry->entryTitle = $item['title'];
        $entry->entryUrl = $item['link_href'];
        $entry->entryFeed = 0;
        $entry->entryId = $item['id'];
        $entry->entryContent = $item['content'];
        $entry->entryUpdatedDate = $item['updated'];
        $entry->save(Connection::getPDO());
    }
}