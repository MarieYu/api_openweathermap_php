<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>METEO</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="js/app.js"></script>
</head>

<?php
    require_once('CityWeather.php');
    require_once('CityPrevision.php');
    if(!isset($_POST['city'])){
        $city = $_POST['city'] = "Nantes";//Nantes default city              
    }
    else{
        $city = ucfirst($_POST['city']);
    }

    // day weather
    $dw = curl_init("http://api.openweathermap.org/data/2.5/weather?q=".$city."&APPID=b9f2c3284d886b97fdbe265ca73b2a4c");
    if($dw){
        curl_setopt($dw, CURLOPT_RETURNTRANSFER, true); //to get data in variable instead of show it in html page 
        $dataWeather = curl_exec($dw);
        curl_close($dw);

        $weather = json_decode($dataWeather);//to get php object
        $cityWeather = new CityWeather($weather);
        $iconId =  $cityWeather->getIconId();
        $measureDate = $cityWeather->getMeasureDate();
        $sunrise = $cityWeather->getSunriseHourFR();
        $sunset = $cityWeather->getSunsetHourFR();
        $humidity = $cityWeather->getHumidity();
        $pressure = $cityWeather->getPressure();
        $wind = $cityWeather->getWindSpeedFR();
        $temp = $cityWeather->getTempC();
        $iconId = $cityWeather->getIconId();
        $lat = $cityWeather->getLat();
        $lon = $cityWeather->getLon();
    } 


    // forecast weather
    $fw = curl_init("http://api.openweathermap.org/data/2.5/forecast/daily?q=".$city."&cnt=6&APPID=b9f2c3284d886b97fdbe265ca73b2a4c");
    if($fw){
        curl_setopt($fw, CURLOPT_RETURNTRANSFER, true); //to get data in variable instead of show it in html page
        $dataForecast = curl_exec($fw);
        curl_close($fw);

        $forecast = json_decode($dataForecast);   
        $cityPrevision = new CityPrevision($forecast);
        $listDays = $cityPrevision->getList(); 
    }
?>


<body>
    <div id="station">
        <h1>STATION METEO</h1>
        <div id="search">
            <h3>Rechercher une ville</h3>
            <form method="POST" id="cityForm" class= "cityForm">
                <input type="text" id="city" class= "cityForm" name="city" placeholder="ex: Nantes">
                <input id="submit" class= "cityForm" type="submit" value="valider"/>
            </form>
        </div>
        <h3 id="title">Météo du <?= $cityWeather->getDateFR()?> pour <?= $city ?></h3>
        <span id="cityWeather">
            <span id="map">
                <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$lat?>,<?=$lon?>&zoom=12&size=250x250&key=AIzaSyBMPVNGjluoxeo6mZaDfTjAUTOb0yzQbuw">
            </span>

            <span id="info">
                <ul>
                    <li>Date de mesure : <?= $measureDate ?></li>
                    <li>Lever du soleil : <?= $sunrise ?></li>
                    <li>Coucher du soleil : <?= $sunset ?></li>
                    <li>Humidité : <?= $humidity ?></li>
                    <li>Pression : <?= $pressure ?></li>
                    <li>Vent : <?= $wind ?></li>
                </ul>
            </span>
            <span id="icon"><img class="iconImg" src="img/<?=$iconId?>.png"/></span>
            <span id="temp"><?= $temp ?></span>
        </span>
        <span id="btn_forecast"><i id="arrowPrev" class="fa fa-arrow-circle-down fa-2x pointer"></i><legend id="prev">Voir les prévisions</legend></span>

        <span id="forecast">
            <?php
                for ($ii = 1; $ii < count($listDays); $ii++) {
                    $icon = $cityPrevision->getIconDay($ii);
                    $temp = $cityPrevision->getTempC($ii);
                    $day = $cityPrevision->getDay($ii);
            ?>
            <span><img class="iconImg" src="img/<?=$icon?>.png"/><p><?=$temp?></br><?=$day?></p></span>

            <?php
                }
            ?>    
        </span>
    </div>
</body>
</html>