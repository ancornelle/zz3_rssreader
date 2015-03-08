<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 11/02/2015
 * Time: 16:50
 */

require_once __DIR__.'/../app/app.php';
require_once __DIR__.'/../src/crawler/Crawler.php';

parseRSSByEntry('https://news.google.com/news/feeds?pz=1&cf=all&ned=us&hl=en&topic=h&num=5&output=rss');
//parseRSSByEntry('http://rss.lemonde.fr/c/205/f/3050/index.rss');
parseAtomByEntry('https://github.com/zelenin/RSSGet/commits/master.atom');

?>

<html>
    <body style="background: #EEEEEE; margin: 0;">
        <div id="divCategory" style="float: left; margin: 0;">
            <img  src="resources/logo.png" width="300" height="300"/>
            <?php
                $entry = new Entry();
                $res = $entry->findAllCategory(Connection::getPDO());
                $string = "<table style='width: 300px;'>";
                $string .= "<tr><td>All Categories</td><td><input type='checkbox' checked='checked'/></td></tr>";
                foreach ($res as $category)
                {
                    $string .= "<tr><td>".$category['entryCategory']."</td><td><input type='checkbox'/></td></tr>";
                }
                echo $string."</table>";
            ?>
        </div>
        <div id="divFil" style="margin-left: 350px; padding-top: 30px;">
            <?php
                $entry = new Entry();
                $res = $entry->findAll(Connection::getPDO());
                $string = "<table style='width: 100%;'>";
                foreach ($res as $entry)
                {
                    $string .= "<tr><td><h3>".$entry['entryTitle']."</h3></td></tr><tr><td><pre>".$entry['entryUpdatedDate']."</pre></td></tr><tr><td><h4>".html_entity_decode($entry['entryContent'])."</h4></td></tr>";
                }
                echo $string."</table>";
            ?>
        </div>
    </body>
</html>