<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 25/02/2015
 * Time: 17:28
 */

// adresse du flux qu'on souhaite intégrer.
$fichier_xml='http://www.lemonde.fr/rss/sequence/0,2-3208,1-0,0.xml';

// appel de la libraire SimplePie.
// require 'simplepie.inc';

// création d'une nouvelle instance de la classe SimplePie.
$feed = new SimplePie();

// on lui indique quel fichier il doit traiter.
$feed->set_feed_url($fichier_xml);

// on peut lui interdire de trier par date. true par défaut.
//$feed->enable_order_by_date(false);

// on lui indique le nom du fichier de cache.
$feed->set_cache_location('cachenews/');

// on lache la pie.
$feed->init();

// Si le flux contient à manger.
if($feed->data){

    // On défini le nombre d'articles qui nous intéressent.
    $max=$feed->get_item_quantity(5);

    // Nous voici au coeur du code d'intégration.
    for($x=0; $x<$max; $x++) {

        // On prend le x-iéme item.
        $item=$feed->get_item($x);

        // Un peu d'habillage html.
        echo "<div style=\"width: 290px; text-align: left;
                padding: 4px; background-color: #FFFFEE;
                border: 1px solid #CCCCCC; margin: 6px;\">
                <a href=\"";

        // le lien ou pointe le flux.
        echo $item->get_permalink();
        echo "\">";

        // le titre du flux.
        echo utf8_decode($item->get_title());
        echo "</a><br />";

        // si enclosure, on affiche. C'est le cas du monde.
        if($enclosure=$item->get_enclosure(0)){

            echo "<img src=\"";
            echo $enclosure->get_link();
            echo "\" border=\"1\" style=\"float: left;
                             margin: 4px; margin-top: 8px;\">";
        }
        // Et la description pour finir.
        echo utf8_decode($item->get_description());
        echo "</div>";
    }

}