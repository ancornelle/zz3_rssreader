<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 17:28
 */

require_once __DIR__.'/../domain/Feed.php';
require_once __DIR__.'/../domain/Entry.php';
require_once __DIR__.'/../domain/Connection.php';

/**
 * @param $pEntryUrl
 */
function parseRSSByEntry($pEntryUrl)
{
    try
    {
        $rssget_rss = new \Zelenin\RSSGet($pEntryUrl);
    }catch (ErrorException $e)
    {
        print "Unreadable Feed";
    }

    $channel = $rssget_rss->getChannel();
    $feed = new Feed();
    $feed->feedId = $channel['title'];
    $feed->feedTitle = $channel['title'];
    $feed->feedUrl = $pEntryUrl;
    $feed->feedUpdatedDate = createDate($channel['pubDate']);
    $feed->feedType = 'RSS';
    array_key_exists('description',$channel) ? $feed->feedDescription = $channel['description'] : $feed->feedDescription = 'No Description';
    $feed->save(Connection::getPDO());

    $items = $rssget_rss->getItems();
    foreach ($items as $item)
    {
        $entry = new Entry();
        array_key_exists('title',$item) ? $entry->entryTitle = $item['title'] : $entry->entryCategory = 'No Title';
        $entry->entryUrl = $item['link'];
        $entry->entryFeed = $feed->feedId;
        array_key_exists('category',$item) ? $entry->entryCategory = $item['category'] : $entry->entryCategory = 'No Category';
        $entry->entryId = $item['guid'];
        array_key_exists('description',$item) ?  $entry->entryContent = $item['description'] : $entry->entryCategory = 'No Description';
        array_key_exists('pubDate',$item) ? $entry->entryUpdatedDate = createDate($item['pubDate']) : $entry->entryUpdatedDate = date('d/m/Y - H:i:s');
        $entry->save(Connection::getPDO());
    }

}

function parseAtomByEntry($pEntryUrl)
{
    try
    {
        $rssget_atom = new \Zelenin\RSSGet($pEntryUrl);
    }catch (ErrorException $e)
    {
        print "Unreadable Feed";
    }
    $channel = $rssget_atom->getChannel();
    $feed = new Feed();
    $feed->feedId = $channel['id'];
    $feed->feedTitle = $channel['title'];
    $feed->feedUrl = $pEntryUrl;
    $feed->feedUpdatedDate = createDate($channel['updated']);
    $feed->feedType = 'Atom';
    array_key_exists('description',$channel) ? $feed->feedDescription = $channel['description'] : $feed->feedDescription = 'No Description';
    $feed->save(Connection::getPDO());

    $items = $rssget_atom->getItems();
    foreach ($items as $item)
    {
        $entry = new Entry();
        array_key_exists('title',$item) ? $entry->entryTitle = $item['title'] : $entry->entryCategory = 'No Title';
        $entry->entryUrl = $item['link_href'];
        $entry->entryFeed = $feed->feedId;
        array_key_exists('category',$item) ? $entry->entryCategory = $item['category'] : $entry->entryCategory = 'No Category';
        $entry->entryId = $item['id'];
        array_key_exists('content',$item) ? $entry->entryContent = $item['content'] : $entry->entryCategory = 'No Content';
        array_key_exists('updated',$item) ? $entry->entryUpdatedDate = createDate($item['updated']) : $entry->entryUpdatedDate = date('d/m/Y - H:i:s');
        $entry->save(Connection::getPDO());
    }
}

function createDate($pUnformatedDate)
{
    $array = date_parse($pUnformatedDate);
    return $array['year']."-".$array['month']."-".$array['day']." - ".$array['hour'].":".$array['minute'].":".$array['second'];
}