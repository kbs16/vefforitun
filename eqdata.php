<? php
$method = $_SERVER['REQUEST_METHOD'];


$ch = curl_init(); // create cURL handle (ch)
if (!$ch) {
    die("Couldn't initialize a cURL handle");
}
// cURL eiginleikar setir inn
$ret = curl_setopt($ch, CURLOPT_URL,            "http://apis.is/cinema");
$ret = curl_setopt($ch, CURLOPT_HEADER,         1);
$ret = curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$ret = curl_setopt($ch, CURLOPT_TIMEOUT,       30);

// execute
$ret = curl_exec($ch);

if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
} 
else {
	$info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler

    if (empty($info['http_code'])) 
    {
            die("No HTTP code was returned");
    } 
    else 
    {
    	$haus_lengd = strpos($ret, "{");
		$hausinn = substr($ret, 0, $haus_lengd - 1 );
		$gognin = substr($ret, $haus_lengd, strlen($ret));

		$afkodud_gogn = json_decode($gognin);

        $jardskjalftar = array();

        echo "<pre>";
        echo $afkodud_gogn;
        echo "</pre>";

        /*foreach($afkodud_gogn->{'results'} as $mynd => $ni){
            $m = new Mov();
            $m->createMovie($ni);
            array_push($myndir, $m);
        }
        echo '<section id=kvikmyndirnar>';
        echo '<h2>Kvikmyndir dagsins '.date("d-m-Y").'</h2>';

        geraMyndatoflu($myndir);
        echo '</section>'*;*/
	}

}

?>