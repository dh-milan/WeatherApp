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

    Weather VARCHAR(100),
    Icon VARCHAR(100),
    temp VARCHAR(100),
    city_name VARCHAR(100),
    pressure VARCHAR(100),
    Wind VARCHAR(100),
    Humidity VARCHAR(100),
    TimeDate DATETIME
)";
if (mysqli_query($conn, $createTable)) {    
} else { 
}
if(isset($_GET['q'])){
    $city_name = $_GET['q'];
}else{
    $city_name = "Montgomery";
}
$selectAllData = "SELECT * FROM city where city_name = '$city_name' ";
$result = mysqli_query($conn, $selectAllData);
$row = mysqli_fetch_assoc($result);
if ($row == null) {
    $apiKey = "a9c001c6a7b8dc2d8044a547c5fac590";
    $url = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=".$city_name.'&apikey=' . $apiKey;
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    $Weather = $data['weather'][0]['description'];
    $Icon= $data['weather'][0]['icon'];
    $temp = $data['main']['temp'];
    $Datee = $data['dt'];
    $pressure = $data['main']['pressure'];
    $Wind = $data['wind']['speed'];
    $Humidity = $data['main']['humidity'];
    $TimeDate = date('Y-m-d H:i:s');
    $insertData = "INSERT INTO city (Weather, Icon, temp , city_name, pressure, Wind, Humidity, TimeDate)
         VALUES ('$Weather','$Icon', '$temp', '$city_name', '$pressure', '$Wind', '$Humidity','$TimeDate')";
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