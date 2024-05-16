<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password);
if ($conn) {
    ;
} else {
}
$createDatabase = "CREATE DATABASE IF NOT EXISTS Weather";
if (mysqli_query($conn, $createDatabase)) {
    
} else {    
}
mysqli_select_db($conn, 'Weather');
$createTable = "CREATE TABLE IF NOT EXISTS city (

    WeatherCondition VARCHAR(100),
    WeatherIcon VARCHAR(100),
    Temperature VARCHAR(100),
    CityName VARCHAR(100),
    Pressure VARCHAR(100),
    Windspeed VARCHAR(100),
    Humidity VARCHAR(100),
    DateeTime DATETIME
)";
if (mysqli_query($conn, $createTable)) {    
} else { 
}
if(isset($_GET['q'])){
    $CityName = $_GET['q'];
}else{
    $CityName = "Montgomery";
}
$selectAllData = "SELECT * FROM city where CityName = '$CityName' ";
$result = mysqli_query($conn, $selectAllData);
$row = mysqli_fetch_assoc($result);
if ($row == null) {
    $apiKey = "a9c001c6a7b8dc2d8044a547c5fac590";
    $url = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=".$CityName.'&apikey=' . $apiKey;
    $response = file_get_contents($url);
    echo $response;
    $data = json_decode($response, true);
    $WeatherCondition = $data['weather'][0]['description'];
    $WeatherIcon= $data['weather'][0]['icon'];
    $Temperature = $data['main']['temp'];
    $Datee = $data['dt'];
    $Pressure = $data['main']['pressure'];
    $Windspeed = $data['wind']['speed'];
    $Humidity = $data['main']['humidity'];
    $DateeTime = date('Y-m-d H:i:s');
    $insertData = "INSERT INTO city (WeatherCondition, WeatherIcon, Temperature , CityName, Pressure, Windspeed, Humidity, DateeTime)
         VALUES ('$WeatherCondition','$WeatherIcon', '$Temperature', '$CityName', '$Pressure', '$Windspeed', '$Humidity','$DateeTime')";
    if (mysqli_query($conn, $insertData)) {
    } else {
    }
}
$result = mysqli_query($conn, $selectAllData);
$row = mysqli_fetch_assoc($result);
$json_data = json_encode($row);
header('Content-Type: application/json');
echo $json_data;
?>