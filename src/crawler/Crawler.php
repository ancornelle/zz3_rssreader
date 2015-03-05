<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 17:28
 */


function parseRSSByEntry($pEntry)
{
    $rssget_rss = new \Zelenin\RSSGet($pEntry);

    echo '<pre>';
    print_r( $rssget_rss->getChannel() );
    print_r( $rssget_rss->getItems() );

}

function parseAtomByEntry($pEntry)
{
    $rssget_atom = new \Zelenin\RSSGet($pEntry);

    echo '<pre>';
    print_r( $rssget_atom->getChannel() );
    print_r( $rssget_atom->getItems() );
}