<!doctype html>
<html lang="en" >
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
<div class="wrapper">
    <header id="mainHeader">
       <h1>Earthquakes in Iceland</h1> 
    </header>
    <nav id="mainNav">
        <h2>Main navigation</h2>
            <ul>
            <li><a href="index.php" title="HOME" class="current">Home</a></li>
            <li><a href="nanar.php" title="NANAR" >Infomation</a></li>
            </ul>
        </nav>
    <div id="adal">
        <section>
            <h2 id="m_section">Main section</h2>
            <article class="adal_articl">
            <h2>Earthquake</h2>    
            <p>An earthquake (also known as a quake, tremor or temblor) is the result of a sudden release of energy
            in the Earth's  crust that creates seismic waves. The seismicity, seismism or seismic activity of an area refers to the
            frequency,   type and size of earthquakes experienced over a period of time.</p> 
            <p>Earthquakes are measured usingobservations from seismometers. The moment magnitude is the most common scale on which earthquakes larger than
            approximately 5 are reported for the entire globe. The more numerous earthquakes smaller than magnitude 5 reported by
            national seismological observatories are measured mostly on the local magnitude scale, also referred to as the Richter
            scale. </p>
        <div id="map_div">
        	<span id="map_tile">Map of Iceland</span>
        	<?php
        	include('googlemaps.php');
        	?>
        </div>
            <p>These two scales are numerically similar over their range of validity. Magnitude 3 or lower earthquakes are
            mostly almost imperceptible or weak and magnitude 7 and over potentially cause serious damage over larger areas,
            depending on their depth. The largest earthquakes in historic times have been of magnitude slightly over 9, although
            there is no limit to the possible magnitude. The most recent large earthquake of magnitude 9.0 or larger was a 9.0
            magnitude earthquake in Japan in 2011 (as of October 2012), and it was the largest Japanese earthquake since records
            began. Intensity of shaking is measured on the modified <img src="image/Fault_types.png" alt="Different type of earthquake" > Mercalli scale. The shallower an earthquake, the more damage to
            structures it causes, all else being equal.</p>
            <p> At the Earth's surface, earthquakes manifest themselves by shaking and sometimes displacement of the ground. When
            the epicenter of a large earthquake is located offshore, the seabed may be displaced sufficiently to cause a tsunami.
            Earthquakes can also trigger landslides, and occasionally volcanic activity. In its most general sense, the word
            earthquake is used to describe any seismic event — whether natural or caused by humans — that generates seismic waves.
            Earthquakes are caused mostly by rupture of geological faults, but also by other events such as volcanic activity,
            landslides, mine blasts, and nuclear tests. An earthquake's point of initial rupture is called its focus or hypocenter.
            The epicenter is the point at ground level directly above the hypocenter.</p> 
            </article>
            <article class="adal_articl">
            <h2>Naturally occurring earthquakes</h2>
            <p>Tectonic earthquakes occur anywhere in the earth where there is sufficient stored elastic strain energy to drive
            fracture propagation along a fault plane. The sides of a fault move past each other smoothly and aseismically only if
            there are no irregularities or asperities along the fault surface that increase the frictional resistance. Most fault
            surfaces do have such asperities and this leads to a form of stick-slip behaviour. Once the fault has locked, continued
            relative motion between the plates leads to increasing stress and therefore, stored strain energy in the volume around
            the fault surface. This continues until the stress has risen sufficiently to break through the asperity, suddenly
            allowing sliding over the locked portion of the fault, releasing the stored energy. This energy is released as a
            combination of radiated elastic strain seismic waves, frictional heating of the fault surface, and cracking of the rock,
            thus causing an earthquake. This process of gradual build-up of strain and stress punctuated by occasional sudden
            earthquake failure is referred to as the elastic-rebound theory. It is estimated that only 10 percent or less of an
            earthquake's total energy is radiated as seismic energy. Most of the earthquake's energy is used to power the earthquake
            fracture growth or is converted into heat generated by friction. Therefore, earthquakes lower the Earth's available
            elastic potential energy and raise its temperature, though these changes are negligible compared to the conductive and
            convective flow of heat out from the Earth's deep interior.</p>
            </article>
    </section>
    </div>
    <div id="hlid">
        <section>
            <h2 id="auka">Why earthquakes</h2>
            <article class="hlidar_art">
            <h2>Earthquake fault types</h2>
                <p>There are three main types of fault, all of which may cause an earthquake: normal, reverse (thrust) and strike-slip. Normal and reverse faulting are examples of dip-slip, where the displacement along the fault is in the direction of dip and movement on them involves a vertical component. Normal faults occur mainly in areas where the crust is being extended such as a divergent boundary. Reverse faults occur in areas where the crust is being shortened such as at a convergent boundary. Strike-slip faults are steep structures where the two sides of the fault slip horizontally past each other; transform boundaries are a particular type of strike-slip fault. Many earthquakes are caused by movement on faults that have components of both dip-slip and strike-slip; this is known as oblique slip.
                <p>Reverse faults, particularly those along convergent plate boundaries are associated with the most powerful earthquakes, including almost all of those of magnitude 8 or more. Strike-slip faults, particularly continental transforms can produce major earthquakes up to about magnitude 8. Earthquakes associated with normal faults are generally less than magnitude 7.</p>
            </article>
            <article class="hlidar_art">
                <h2>Earthquakes away from plate boundaries</h2>
                <p>Where plate boundaries occur within continental lithosphere, deformation is spread out over a much larger area than the plate boundary itself. In the case of the San Andreas fault continental transform, many earthquakes occur away from the plate boundary and are related to strains developed within the broader zone of deformation caused by major irregularities in the fault trace (e.g., the "Big bend" region). The Northridge earthquake was associated with movement on a blind thrust within such a zone. Another example is the strongly oblique convergent plate boundary between the Arabian and Eurasian plates where it runs through the northwestern part of the Zagros mountains. The deformation associated with this plate boundary is partitioned into nearly pure thrust sense movements perpendicular to the boundary over a wide zone to the southwest and nearly pure strike-slip motion along the Main Recent Fault close to the actual plate boundary itself. This is demonstrated by earthquake focal mechanisms.
                All tectonic plates have internal stress fields caused by their interactions with neighbouring plates and sedimentary loading or unloading (e.g. deglaciation). These stresses may be sufficient to cause failure along existing fault planes, giving rise to intraplate earthquakes.</p>
            </article>
            <article class="hlidar_art">
                <h2>Shallow-focus and deep-focus earthquakes</h2>
                <p>The majority of tectonic earthquakes originate at the ring of fire in depths not exceeding tens of kilometers. Earthquakes occurring at a depth of less than 70 km are classified as 'shallow-focus' earthquakes, while those with a focal-depth between 70 and 300 km are commonly termed 'mid-focus' or 'intermediate-depth' earthquakes. In subduction zones, where older and colder oceanic crust descends beneath another tectonic plate, deep-focus earthquakes may occur at much greater depths (ranging from 300 up to 700 kilometers). These seismically active areas of subduction are known as Wadati-Benioff zones. Deep-focus earthquakes occur at a depth where the subducted lithosphere should no longer be brittle, due to the high temperature and pressure. A possible mechanism for the generation of deep-focus earthquakes is faulting caused by olivine undergoing a phase transition into a spinel structure.</p>
            </article>
        </section>
    </div>
    	<footer>
            <div class="footerbox">
                <span>
    		      Höfundar eru:<br>Alfreð Símonarson : als34 hjá hi púnktur is<br>Karl Björgvin Sveinsson : kbs16 hjá hi púnktur is
                  
                </span>
            </div>
        </footer>	
</div>
</body>
</html>
