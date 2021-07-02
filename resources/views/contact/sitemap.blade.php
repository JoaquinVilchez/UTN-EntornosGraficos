<?php
$urls = simplexml_load_file('sitemap.xml');
foreach($urls as $url)
{
    echo "Direccion: " . $url->loc; echo "<br>";
    echo "Ultima modificación: " . $url->lastmod; echo "<br>";
    echo "Frecuencia de cambio: " . $url->changefreq; echo "<br>";
    echo "Prioridad: " . $url->priority; echo "<br>"; echo "<br>";
}