<!doctype html>
<html lang="is" >
<head>
<meta charset="utf-8">
<link href="_css/main.css" rel="stylesheet" media="screen, projection">
<?php
	header('Content-Type: text/html; charset=utf-8');
    const DEBUG = false;
    const CACHE_TIME = 600;
    const CACHE_FS = 'cache/';
    const EQ_URL = 'http://apis.is/earthquake/is';

    // Our dependencies
    $logger = require('log.php');
    $cache = require('cache.php');
    require('restclient.class.php');

    // Track how long we're doing all of this
    $logger->Log("Starting");

    $rest = new RestClient($cache, $logger);

    try
    {
        $data = $rest->Get(EQ_URL, true);
    }
    catch (Exception $e)
    {
        // if we couldn't get any data, set it to false, the view knows how to handle it
        $data = false;
    }

    if ($data != false)
    {
        $earthquakes = $data["results"];
    }
?>
<title>Lokaverkefni í Vefforritun</title>
</head>

<body>
<header id="mainHeader">
<hgroup>
<h1>Lokaverkefni í vefforritun, Jarðskjálftar á Íslandi</h1>
<h2>Á þessari síðu er hægt að velja tímabil og styrk jarðskjálfta á heimsvísu</h2>
</hgroup>
<nav>
    	<ul>
        <li><a href="index.php" title="HOME" class="current">Home</a></li>
        <li><a href="nanar.php" title="NANAR" >Infomation</a></li>
        <li><a href="#" title=""></a></li>
        <li><a href="#" title=""></a></li>
        </ul>
    </nav>
</header>
<section id="adal">
	<h2>Heimskortið</h2>
	<?php
	include('googlemaps.php');

	?>

</section>
<article id="hlid">
<h2>Debug</h2>
<?php
include('eqdata.php');
?>
<h2>Dynjandi</h2>
<p>Phasellus consectetur, ante et sollicitudin sollicitudin, nisi arcu consectetur mauris, id vulputate justo quam quis ipsum. Donec varius pellentesque pretium. Phasellus a nulla odio. Sed commodo enim quam. Donec id justo eget dui luctus fermentum in non nisl. Quisque blandit, ligula sit amet posuere convallis, justo diam ullamcorper ante, vitae elementum lacus turpis non lectus. Donec ullamcorper urna sit amet urna luctus, ac tincidunt felis porta. Maecenas tristique augue non nunc semper pharetra. Sed egestas, elit ac tincidunt auctor, ipsum tortor imperdiet neque, nec egestas purus orci sed lectus.
</p>
<h2>Goðafoss</h2>
<p>Suspendisse potenti. Quisque rhoncus metus ante, quis aliquet justo imperdiet porttitor. Mauris scelerisque metus metus, tincidunt semper lectus feugiat vitae. Suspendisse hendrerit, felis eu gravida feugiat, lectus nibh feugiat augue, et consectetur justo diam ac dui. Pellentesque ut ipsum enim. Fusce in sem sed ante venenatis facilisis. Sed aliquam risus eros, ac pretium sapien porttitor quis. Aenean ornare lorem ut hendrerit tempus. Donec ut fringilla arcu, porttitor vestibulum orci. Nam id velit interdum, venenatis sem ac, dapibus metus. Curabitur elementum gravida facilisis. Nullam vitae convallis turpis. Maecenas eget justo sed augue posuere bibendum vel eu eros. Integer sapien urna, gravida eget consequat eu, ultricies at tellus.
</p>
<h2>Dettifoss</h2>
<p>Aenean venenatis mi in  rutrum gravida tortor vitae tristique. Cras pretium, tellus ac sodales pharetra, erat mi venenatis turpis, quis iaculis ante nulla eget tortor. Vivamus pretium, est non placerat placerat, diam ligula sollicitudin tortor, quis tincidunt risus eros ut lectus. Ut volutpat elementum elit, et accumsan velit porta id. Nulla metus magna, dapibus ac rhoncus non, lacinia id ipsum. Etiam libero diam, imperdiet ut fringilla ut, consequat vel tortor. Vestibulum gravida, neque ac pulvinar laoreet, magna lectus ornare orci, sed malesuada tortor diam et ligula. Maecenas eu magna ipsum.
</p>
</article>
	<footer>
		<h3>Höfunda eru:<br>Alfreð Símonarson : als34 hjá hi púnktur is<br>Karl Björgvin Sveinsson : kbs16 hjá hi púnktur is</h3>
    </footer>	
</body>
</html>
