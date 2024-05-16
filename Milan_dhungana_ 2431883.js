const currentDate = new Date();
const date = currentDate.toLocaleDateString('en-US', { month: '2-digit', day: '2-digit', year: '2-digit' });

document.getElementById('today').innerText = date;

const API_KEY = 'a9c001c6a7b8dc2d8044a547c5fac590';
const search = document.getElementById('search');
const cityName = document.getElementById('city_name');
const temp = document.getElementById('Temperature');
const humidity = document.getElementById('humidity');
const wind = document.getElementById('windspeed');
const pressure = document.getElementById('Pressure');
const weatherIcon = document.getElementById('weatherIcon');

search.addEventListener('click', () => {
  const city = document.querySelector('input').value;
  makeRequest(city)
});
async function makeRequest(city){
  try {
    const response = await fetch(`http://localhost/weatherapp/index.php?q=${city}`);
    const data = await response.json();
    console.log(data)
    if(data.Temperature){
        cityName.innerText = data.CityName
        temp.innerHTML = `${data.Temperature}`
        
        let icon_url = `https://openweathermap.org/img/wn/${data.WeatherIcon}@2x.png`
        console.log(icon_url)
        weatherIcon.src = icon_url;
        humidity.innerText = `${data.Humidity}%`;
        wind.innerHTML= `${data.Windspeed} km/h`; 
        pressure.innerText = `${data.Pressure}`; 
    }
  }
  catch (error){
    console.log(error)
  }
}
makeRequest('Montgomery');