<?php
/**
 * @package Kindergarten
 *
 * @author  : Gewerbe
 * @since   : 02.01.2019
 * @class   Tools.php
 */

class Tools
{
    static $aOrte = [
    
        13 => array('ort' => 'Emleben', 'region' => 1),
        96 => array('ort' => 'Georgenthal außer Am Vitzerod, Lohmühle, Hesserod und Neues Haus', 'region' => 1),
        98 => array('ort' => 'Georgenthal nur Am Vitzerod, Lohmühle und Hesserod', 'region' => 1),
        905 => array('ort' => 'Georgenthal nur Neues Haus', 'region' => 1),
        882 => array('ort' => 'Georgenthal OT Nauendorf', 'region' => 1),
        521 => array('ort' => 'Herrenhof', 'region' => 1),
        523 => array('ort' => 'Hohenkirchen', 'region' => 1),
        625 => array('ort' => 'Petriroda', 'region' => 1),
        665 => array('ort' => 'Ackergasse', 'region' => 14),
        672 => array('ort' => 'Alexandrinenweg', 'region' => 14),
        671 => array('ort' => 'Am Burgholz', 'region' => 14),
        670 => array('ort' => 'Am Hügel', 'region' => 14),
        669 => array('ort' => 'Am Jagdhaus', 'region' => 14),
        668 => array('ort' => 'Am Klauenberg', 'region' => 14),
        673 => array('ort' => 'Am Mönchhof', 'region' => 14),
        666 => array('ort' => 'Am Tabarzer Berg', 'region' => 14),
        677 => array('ort' => 'Amselweg', 'region' => 14),
        664 => array('ort' => 'An der Schaltstation', 'region' => 14),
        667 => array('ort' => 'Ardennenstraße', 'region' => 14),
        674 => array('ort' => 'Auestraße', 'region' => 14),
        676 => array('ort' => 'Böttchergasse', 'region' => 14),
        661 => array('ort' => 'Brühl', 'region' => 14),
        678 => array('ort' => 'Datenbergstraße', 'region' => 14),
        679 => array('ort' => 'Deysingslust', 'region' => 14),
        680 => array('ort' => 'Ecke', 'region' => 14),
        681 => array('ort' => 'Falkenweg', 'region' => 14),
        682 => array('ort' => 'Finkenweg', 'region' => 14),
        683 => array('ort' => 'Fischbacher Straße', 'region' => 14),
        684 => array('ort' => 'Friedensweg', 'region' => 14),
        685 => array('ort' => 'Friedhofstraße', 'region' => 14),
        675 => array('ort' => 'Friedrichrodaer Straße', 'region' => 14),
        662 => array('ort' => 'Gartenstraße', 'region' => 14),
        632 => array('ort' => 'Gladenbacher Straße', 'region' => 14),
        633 => array('ort' => 'H.-Hoffmann-Straße', 'region' => 14),
        635 => array('ort' => 'Hainstraße', 'region' => 14),
        663 => array('ort' => 'Inselsbergstraße', 'region' => 14),
        637 => array('ort' => 'Karl-Kornhaß-Straße', 'region' => 14),
        636 => array('ort' => 'Karl-Marx-Straße', 'region' => 14),
        638 => array('ort' => 'Kurhausweg', 'region' => 14),
        639 => array('ort' => 'Langenhainer Straße', 'region' => 14),
        640 => array('ort' => 'Lauchagrundstraße', 'region' => 14),
        641 => array('ort' => 'Lindenstraße', 'region' => 14),
        642 => array('ort' => 'Max-Alvary-Straße', 'region' => 14),
        643 => array('ort' => 'Meisenweg', 'region' => 14),
        644 => array('ort' => 'Mittelweg', 'region' => 14),
        645 => array('ort' => 'Mühlbachstraße', 'region' => 14),
        658 => array('ort' => 'Nonnenberg', 'region' => 14),
        634 => array('ort' => 'Reinhardsbrunner Straße', 'region' => 14),
        646 => array('ort' => 'Schulplatz', 'region' => 14),
        660 => array('ort' => 'Schulstraße', 'region' => 14),
        659 => array('ort' => 'Schwarzhäuser Straße', 'region' => 14),
        657 => array('ort' => 'Schwimmbadweg', 'region' => 14),
        656 => array('ort' => 'Theo-Neubauer-Park', 'region' => 14),
        655 => array('ort' => 'Töpfersberg', 'region' => 14),
        653 => array('ort' => 'Übelbergweg', 'region' => 14),
        652 => array('ort' => 'Über dem Kirchweg', 'region' => 14),
        651 => array('ort' => 'Untergasse', 'region' => 14),
        650 => array('ort' => 'Waldstraße', 'region' => 14),
        649 => array('ort' => 'Waltershäuser Straße', 'region' => 14),
        654 => array('ort' => 'Walther-Rathenau-Straße', 'region' => 14),
        648 => array('ort' => 'Zimmerbergstraße', 'region' => 14),
        647 => array('ort' => 'Zum Wachkopf', 'region' => 14),
        629 => array('ort' => 'OT Cobstädt', 'region' => 2),
        513 => array('ort' => 'OT Grabsleben', 'region' => 2),
        863 => array('ort' => 'OT Großrettbach', 'region' => 2),
        519 => array('ort' => 'OT Günthersleben', 'region' => 2),
        514 => array('ort' => 'OT Mühlberg', 'region' => 2),
        541 => array('ort' => 'OT Seebergen', 'region' => 2),
        515 => array('ort' => 'OT Wandersleben', 'region' => 2),
        518 => array('ort' => 'OT Wechmar', 'region' => 2),
        919 => array('ort' => 'Schwabhausen', 'region' => 2),
        10 => array('ort' => 'Dachwig', 'region' => 4),
        11 => array('ort' => 'Döllstädt', 'region' => 4),
        101 => array('ort' => 'Gierstädt OT Giertstädt', 'region' => 4),
        100 => array('ort' => 'Gierstädt OT Kleinfahner', 'region' => 4),
        517 => array('ort' => 'Großfahner', 'region' => 4),
        745 => array('ort' => 'Tonna OT Burgtonna', 'region' => 4),
        746 => array('ort' => 'Tonna OT Gräfentonna', 'region' => 4),
        19 => array('ort' => 'OT Ernstroda/Cumbach', 'region' => 13),
        20 => array('ort' => 'OT Finsterbergen', 'region' => 13),
        900 => array('ort' => 'OT Ernstroda', 'region' => 13),
        330 => array('ort' => '18.-März-Straße', 'region' => 5),
        331 => array('ort' => 'Adolf-Schmidt-Straße', 'region' => 5),
        332 => array('ort' => 'Ahornweg', 'region' => 5),
        329 => array('ort' => 'Alschleber Weg', 'region' => 5),
        334 => array('ort' => 'Alte Kirchstraße', 'region' => 5),
        325 => array('ort' => 'Am Aquarium', 'region' => 5),
        335 => array('ort' => 'Am Friedhof', 'region' => 5),
        333 => array('ort' => 'Am Gustav-Freytag-Park', 'region' => 5),
        328 => array('ort' => 'Am Kindleber Feld', 'region' => 5),
        336 => array('ort' => 'Am Königsbrunnen', 'region' => 5),
        326 => array('ort' => 'Am Lindenhügel', 'region' => 5),
        341 => array('ort' => 'Am Luftschiffhafen', 'region' => 5),
        324 => array('ort' => 'Am Mönchhof', 'region' => 5),
        323 => array('ort' => 'Am Peter', 'region' => 5),
        322 => array('ort' => 'Am Schafrasen', 'region' => 5),
        321 => array('ort' => 'Am Schmalen Rain', 'region' => 5),
        320 => array('ort' => 'Am Seeberg', 'region' => 5),
        319 => array('ort' => 'Am Sembach', 'region' => 5),
        327 => array('ort' => 'Am Stadtfeld', 'region' => 5),
        346 => array('ort' => 'Am Steinborn', 'region' => 5),
        355 => array('ort' => 'Am Steinkreuz', 'region' => 5),
        354 => array('ort' => 'Am Stockborn', 'region' => 5),
        353 => array('ort' => 'Am Teichdamm', 'region' => 5),
        352 => array('ort' => 'Am Tivoli', 'region' => 5),
        351 => array('ort' => 'Am Viadukt', 'region' => 5),
        350 => array('ort' => 'Am Volkspark', 'region' => 5),
        349 => array('ort' => 'Am Wiegwasser', 'region' => 5),
        339 => array('ort' => 'Amselweg', 'region' => 5),
        347 => array('ort' => 'An den Hundert Äckern', 'region' => 5),
        337 => array('ort' => 'An den sieben Teichen', 'region' => 5),
        345 => array('ort' => 'An der Goth', 'region' => 5),
        344 => array('ort' => 'An der Kirschwiese', 'region' => 5),
        343 => array('ort' => 'An der Ostbahn', 'region' => 5),
        405 => array('ort' => 'An der Rot', 'region' => 5),
        342 => array('ort' => 'An der Wolfgangwiese', 'region' => 5),
        315 => array('ort' => 'An der Wolfsgrube', 'region' => 5),
        340 => array('ort' => 'Anger', 'region' => 5),
        338 => array('ort' => 'Annastraße', 'region' => 5),
        348 => array('ort' => 'Arndtstraße', 'region' => 5),
        283 => array('ort' => 'Arnoldiplatz', 'region' => 5),
        293 => array('ort' => 'August-Creutzburg-Straße', 'region' => 5),
        292 => array('ort' => 'Augustinerstraße', 'region' => 5),
        291 => array('ort' => 'Bachstraße', 'region' => 5),
        290 => array('ort' => 'Backhausgasse', 'region' => 5),
        289 => array('ort' => 'Backhausstieg', 'region' => 5),
        288 => array('ort' => 'Bahnhofstraße', 'region' => 5),
        287 => array('ort' => 'Bahnweg', 'region' => 5),
        286 => array('ort' => 'Baumschulenweg', 'region' => 5),
        317 => array('ort' => 'Bebelstraße', 'region' => 5),
        284 => array('ort' => 'Beethovenstraße', 'region' => 5),
        296 => array('ort' => 'Behringer Weg', 'region' => 5),
        356 => array('ort' => 'Bendastraße', 'region' => 5),
        282 => array('ort' => 'Berg', 'region' => 5),
        281 => array('ort' => 'Bergallee', 'region' => 5),
        280 => array('ort' => 'Berggartenweg', 'region' => 5),
        279 => array('ort' => 'Bergweg', 'region' => 5),
        278 => array('ort' => 'Bertha-Schneyer-Straße', 'region' => 5),
        277 => array('ort' => 'Bertha-von-Suttner-Straße', 'region' => 5),
        276 => array('ort' => 'Birkenweg', 'region' => 5),
        285 => array('ort' => 'Blumenbachstraße', 'region' => 5),
        305 => array('ort' => 'Böhnerstraße', 'region' => 5),
        316 => array('ort' => 'Bohnstedtstraße', 'region' => 5),
        314 => array('ort' => 'Boilstädter Platz', 'region' => 5),
        313 => array('ort' => 'Boilstädter Straße', 'region' => 5),
        312 => array('ort' => 'Boilstädter Weg', 'region' => 5),
        311 => array('ort' => 'Boxberg', 'region' => 5),
        310 => array('ort' => 'Boxbergstraße', 'region' => 5),
        309 => array('ort' => 'Brahmsweg', 'region' => 5),
        308 => array('ort' => 'Brauhausstraße', 'region' => 5),
        294 => array('ort' => 'Breite Gasse', 'region' => 5),
        306 => array('ort' => 'Breitenbachstraße', 'region' => 5),
        295 => array('ort' => 'Breiter Weg', 'region' => 5),
        304 => array('ort' => 'Breitscheidstraße', 'region' => 5),
        303 => array('ort' => 'Brieglebstraße', 'region' => 5),
        302 => array('ort' => 'Brückengasse', 'region' => 5),
        301 => array('ort' => 'Brückenstraße', 'region' => 5),
        300 => array('ort' => 'Brühl', 'region' => 5),
        299 => array('ort' => 'Brunnenstraße', 'region' => 5),
        298 => array('ort' => 'Buchwaldgasse', 'region' => 5),
        297 => array('ort' => 'Bufleber Straße', 'region' => 5),
        318 => array('ort' => 'Bürgeraue', 'region' => 5),
        307 => array('ort' => 'Burgfreiheit', 'region' => 5),
        409 => array('ort' => 'Buttermarkt', 'region' => 5),
        403 => array('ort' => 'Carl-Vogel-Weg', 'region' => 5),
        418 => array('ort' => 'Carl-von-Ossietzky-Straße', 'region' => 5),
        417 => array('ort' => 'Clara-Zetkin-Straße', 'region' => 5),
        416 => array('ort' => 'Cobstädter Weg', 'region' => 5),
        415 => array('ort' => 'Coburger Platz', 'region' => 5),
        414 => array('ort' => 'Cosmarstraße', 'region' => 5),
        413 => array('ort' => 'Cyrusstraße', 'region' => 5),
        889 => array('ort' => 'OT Aspach', 'region' => 7),
        890 => array('ort' => 'OT Ebenheim', 'region' => 7),
        891 => array('ort' => 'OT Fröttstädt', 'region' => 7),
        892 => array('ort' => 'OT Hörselgau', 'region' => 7),
        893 => array('ort' => 'OT Laucha', 'region' => 7),
        894 => array('ort' => 'OT Mechterstädt', 'region' => 7),
        895 => array('ort' => 'OT Metebach', 'region' => 7),
        896 => array('ort' => 'OT Neufrankenroda', 'region' => 7),
        897 => array('ort' => 'OT Teutleben', 'region' => 7),
        898 => array('ort' => 'OT Trügleben', 'region' => 7),
        899 => array('ort' => 'OT Weingarten', 'region' => 7),
        534 => array('ort' => 'OT Altenbergen', 'region' => 8),
        533 => array('ort' => 'OT Catterfeld', 'region' => 8),
        530 => array('ort' => 'OT Engelsbach', 'region' => 8),
        532 => array('ort' => 'OT Gospiteroda außer Boxberg', 'region' => 8),
        528 => array('ort' => 'OT Gospiteroda nur Boxberg', 'region' => 8),
        531 => array('ort' => 'OT Leina außer auf dem Boxberg', 'region' => 8),
        527 => array('ort' => 'OT Leina nur auf dem Boxberg', 'region' => 8),
        535 => array('ort' => 'OT Schönau v.d. Walde', 'region' => 8),
        529 => array('ort' => 'OT Wipperoda', 'region' => 8),
        3 => array('ort' => 'Ballstädt', 'region' => 9),
        5 => array('ort' => 'Brüheim', 'region' => 9),
        8 => array('ort' => 'Bufleben OT Bufleben', 'region' => 9),
        6 => array('ort' => 'Bufleben OT Hausen', 'region' => 9),
        7 => array('ort' => 'Bufleben OT Pfullendorf', 'region' => 9),
        879 => array('ort' => 'Friedrichswerth', 'region' => 9),
        102 => array('ort' => 'Goldbach', 'region' => 9),
        520 => array('ort' => 'Haina', 'region' => 9),
        522 => array('ort' => 'Hochheim', 'region' => 9),
        631 => array('ort' => 'OT Eberstädt', 'region' => 9),
        913 => array('ort' => 'OT Sonneborn', 'region' => 9),
        627 => array('ort' => 'Remstädt', 'region' => 9),
        864 => array('ort' => 'Wangenheim', 'region' => 9),
        865 => array('ort' => 'Warza', 'region' => 9),
        867 => array('ort' => 'Westhausen', 'region' => 9),
        1 => array('ort' => 'OT Apfelstädt', 'region' => 10),
        95 => array('ort' => 'OT Gamstädt', 'region' => 10),
        874 => array('ort' => 'OT Ingersleben', 'region' => 10),
        543 => array('ort' => 'OT Kleinrettbach', 'region' => 10),
        542 => array('ort' => 'OT Kornhochheim', 'region' => 10),
        94 => array('ort' => 'OT Neudietendorf', 'region' => 10),
        4 => array('ort' => 'Bienstädt', 'region' => 11),
        18 => array('ort' => 'Eschenbergen', 'region' => 11),
        92 => array('ort' => 'Friemar', 'region' => 11),
        540 => array('ort' => 'Molschleben', 'region' => 11),
        544 => array('ort' => 'Nottleben', 'region' => 11),
        626 => array('ort' => 'Pferdingsleben', 'region' => 11),
        747 => array('ort' => 'Tröchtelborn', 'region' => 11),
        749 => array('ort' => 'Tüttleben', 'region' => 11),
        869 => array('ort' => 'Zimmernsupra', 'region' => 11),
        516 => array('ort' => 'Gräfenhain', 'region' => 12),
        536 => array('ort' => 'Luisenthal', 'region' => 12),
        9 => array('ort' => 'Crawinkel', 'region' => 12),
        868 => array('ort' => 'Wölfis', 'region' => 12),
        723 => array('ort' => 'Am Kirchberg', 'region' => 15),
        912 => array('ort' => 'Am Schmalkalder Stieg', 'region' => 15),
        731 => array('ort' => 'Am Schnepfenstein', 'region' => 15),
        730 => array('ort' => 'An den Salztrögen', 'region' => 15),
        729 => array('ort' => 'An der Burg', 'region' => 15),
        728 => array('ort' => 'Apfelstädter Straße', 'region' => 15),
        727 => array('ort' => 'August-Bebel-Straße', 'region' => 15),
        726 => array('ort' => 'Bahnhofstraße', 'region' => 15),
        722 => array('ort' => 'Bechergasse', 'region' => 15),
        724 => array('ort' => 'Bergstraße', 'region' => 15),
        732 => array('ort' => 'Brauhausstraße', 'region' => 15),
        743 => array('ort' => 'Breitemarkstein', 'region' => 15),
        721 => array('ort' => 'Burgstallstraße', 'region' => 15),
        725 => array('ort' => 'Das Hammerholz', 'region' => 15),
        733 => array('ort' => 'Finsterberger Straße', 'region' => 15),
        734 => array('ort' => 'Friedrich-Hörchner-Straße', 'region' => 15),
        735 => array('ort' => 'Friedrichrodaer Straße', 'region' => 15),
        736 => array('ort' => 'Fuchsbergstraße', 'region' => 15),
        738 => array('ort' => 'Gallbergstraße', 'region' => 15),
        740 => array('ort' => 'Gartenstraße', 'region' => 15),
        742 => array('ort' => 'Grenzstraße', 'region' => 15),
        878 => array('ort' => 'Hauptstraße', 'region' => 15),
        877 => array('ort' => 'Heinrich-Heine-Straße', 'region' => 15),
        876 => array('ort' => 'Hesserod', 'region' => 15),
        720 => array('ort' => 'Högstraße', 'region' => 15),
        737 => array('ort' => 'Hohe Warte', 'region' => 15),
        741 => array('ort' => 'Hopfenberg', 'region' => 15),
        691 => array('ort' => 'Im Grund', 'region' => 15),
        700 => array('ort' => 'Kirchstraße', 'region' => 15),
        699 => array('ort' => 'Kleine Verbindungsstraße', 'region' => 15),
        698 => array('ort' => 'Lutherstraße', 'region' => 15),
        697 => array('ort' => 'Mösweg', 'region' => 15),
        695 => array('ort' => 'Mühlenstraße', 'region' => 15),
        694 => array('ort' => 'Nesselberg', 'region' => 15),
        701 => array('ort' => 'Neue Straße', 'region' => 15),
        692 => array('ort' => 'Nordstraße', 'region' => 15),
        696 => array('ort' => 'Oberhofer Straße', 'region' => 15),
        690 => array('ort' => 'Oststraße', 'region' => 15),
        719 => array('ort' => 'Oswaldstraße', 'region' => 15),
        739 => array('ort' => 'Pfarrstraße', 'region' => 15),
        689 => array('ort' => 'Poststraße', 'region' => 15),
        688 => array('ort' => 'Querstraße', 'region' => 15),
        687 => array('ort' => 'Robert-Koch-Straße', 'region' => 15),
        686 => array('ort' => 'Rödichenstraße', 'region' => 15),
        693 => array('ort' => 'Schmalkalder Straße', 'region' => 15),
        708 => array('ort' => 'Schützenstraße', 'region' => 15),
        716 => array('ort' => 'Sebastiansweg', 'region' => 15),
        715 => array('ort' => 'Seeberger Fahrt', 'region' => 15),
        714 => array('ort' => 'Sontraer Straße', 'region' => 15),
        713 => array('ort' => 'Spitterlaite', 'region' => 15),
        712 => array('ort' => 'Spitterstraße', 'region' => 15),
        711 => array('ort' => 'Steigerstraße', 'region' => 15),
        710 => array('ort' => 'Steinbacher Straße', 'region' => 15),
        709 => array('ort' => 'Straße der Einheit', 'region' => 15),
        707 => array('ort' => 'Straße des Friedens', 'region' => 15),
        717 => array('ort' => 'Talsperrstraße', 'region' => 15),
        702 => array('ort' => 'Tammichstraße', 'region' => 15),
        704 => array('ort' => 'Triftstraße', 'region' => 15),
        718 => array('ort' => 'Waldstraße', 'region' => 15),
        705 => array('ort' => 'Weststraße', 'region' => 15),
        703 => array('ort' => 'Wiesenweg', 'region' => 15),
        706 => array('ort' => 'Zipfel', 'region' => 15),
        14 => array('ort' => 'OT Schwarzhausen', 'region' => 16),
        15 => array('ort' => 'OT Winterstein', 'region' => 16),
        16 => array('ort' => 'OT Schmerbach', 'region' => 16),
        17 => array('ort' => 'OT Fischbach', 'region' => 16),
        750 => array('ort' => 'OT Schnepfenthal', 'region' => 16),
        751 => array('ort' => 'OT Langenhain', 'region' => 16),
        752 => array('ort' => 'OT Wahlwinkel', 'region' => 16)
    ];
    
    static $aTonnentyp = [
        'R11' => 'Hausmüll',
        'B2' => 'Biomüll',
        'G14' => 'Gelber Sack',
       /* 'P2' => 'Papier'*/
    ];
    
    public static function getOrtText($iOrt) {
        return self::$aOrte[$iOrt];
    }
    
    public static function getTonnentypText($sIndex) {
        return self::$aTonnentyp[$sIndex];
    }
}