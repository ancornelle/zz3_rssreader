<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 11/02/2015
 * Time: 16:50
 */

require_once __DIR__.'/../app/app.php';
require_once __DIR__.'/../src/crawler/Crawler.php';

echo 'Hello World';
//parseRSSByEntry('https://news.google.com/news/feeds?pz=1&cf=all&ned=us&hl=en&topic=h&num=3&output=rss');
parseAtomByEntry('https://github.com/zelenin/RSSGet/commits/master.atom');