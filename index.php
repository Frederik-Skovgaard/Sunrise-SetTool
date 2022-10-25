<?php

// Properties
$isTrue = true;

// Get the number of days between dates
function dateDiffInDays($date1, $date2)
{
    $diff = strtotime($date2) - strtotime($date1);

    // 1 day = 24 hours
    // 24 * 60 * 60 = 86400 seconds
    return abs(round($diff / 86400));
}

// Return sunrise/set times of each day, between todays date or selected date, til nearest Sunday.
function GetSunRiseSetData(){
    $cityInput = $_POST['CityName'];

    // Return error message if city is null
    if (empty($cityInput)) {return "City name most be given...";}

    if (!empty($_POST['DateInput'])) {$dateInput = $_POST['DateInput'];}
    ?>

    <!--After post input field-->
    <h1><?php echo $cityInput; ?></h1>
    <form method="post">
        <div class="row">
            <div class="d-flex">
                <input class="form-control" name="CityName" value="<?php echo $cityInput ?>" placeholder="Enter City Name!" type="text"  >
                <input class="form-control" name="DateInput" value="<?php echo $dateInput ?>" type="date"  >
                <input class="btn btn-primary" type="submit" name="Update" value="Update">
            </div>
        </div>
    </form>
    <div class="container d-flex justify-content-around">

        <?php

        // OpenWeatherAPI
        $url = "http://api.openweathermap.org/data/2.5/weather?q={$cityInput}&mode=xml&units=metric&appid=170163e1f39ccff193006239eea74791";

        // Read lon and lat from OpenWeatherAPI
        $xml = new SimpleXMLElement($url, 0, true);
        $lon = $xml->city[0]->coord['lon'];
        $lat = $xml->city[0]->coord['lat'];

        // Get the number of days between todays date and next sunday
        $now = time();

        // If no date given default to todays date
        if (!empty($dateInput))
        {
            $now = strtotime($dateInput);
            $futureDate = date("Y/m/d", strtotime(date('Y/m/d', $now) . "next sunday"));
            $dateDif = dateDiffInDays($dateInput, $futureDate);
        }
        else {
            $futureDate = strtotime('next sunday');
            $dateDif = dateDiffInDays(date('Y/m/d', $futureDate), date('Y/m/d', $now) );
        }

        // Loop through days between given dates
        for ($x = 0; $x <= $dateDif; $x++)
        {
            //Date for url
            $time = date("Y-m-d", strtotime(date('Y/m/d', $now) . "+{$x} day"));

            //Sunset and sunrise times API
            $url = "http://api.sunrise-sunset.org/json?lat=$lat&lng=$lon&date=$time";

            $json = file_get_contents($url);
            $json = json_decode($json, true); ?>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><?php echo date('l', strtotime($time)) ?></h2>
                    <h4 class="card-text">Sunrise: <?php echo date("G:i", strtotime($json['results']['sunrise'])); ?></h4>
                    <h4 class="card-text">Sunset: <?php echo date("G:i", strtotime($json['results']['sunset'])); ?></h4>
                </div>
            </div>

            <?php

        } ?>
    </div>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Improving-Project</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="inc/css.css" rel="stylesheet">

</head>
<body>
<div class="container">
<?php
if ( array_key_exists('Update', $_POST)) {
    $isTrue = false;

    $errorMes = GetSunRiseSetData();
    if (!empty($errorMes)) {$isTrue = true;}
}
?>


<?php if($isTrue) {?>


    <!--Pre post input field-->
    <div class="centered">

        <label>Enter City </label>
        <form method="post" class="d-flex">
            <div class="row">
                <input class="form-control" name="CityName" placeholder="Enter City Name!" type="text"  >
                <input class="btn btn-primary Update" type="submit" name="Update" value="Update">

                <label>For specific date (Not required)</label>
                <input class="form-control" name="DateInput"  type="date"  >
            </div>
        </form>

        <!--Error Message-->
        <?php if (!empty($errorMes)) {?>
            <label class="errorMessage"><?php echo $errorMes ?></label>
        <?php } ?>
    </div>

<?php }?>

</body>
</html>

