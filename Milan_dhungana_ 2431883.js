const API_KEY = 'a9c001c6a7b8dc2d8044a547c5fac590';
const search = document.getElementById('search');
const cityName = document.getElementById('city_name');
const temp = document.getElementById('temp');
const humidity = document.getElementById('humidity');
const wind = document.getElementById('wind');
const pressure = document.getElementById('pressure');
const weatherIcon = document.getElementById('weatherIcon');
const today = document.getElementById('today');
const weather = document.getElementById('weather');



search.addEventListener('click', () => {
  const city = document.querySelector('input').value;
  makeRequest(city)
});
async function makeRequest(city){
  try {
    const response = await fetch(`http://localhost/weatherapp/index.php?q=${city}`);
    const data = await response.json();
    console.log(data)
    if(data.temp){
        cityName.innerText = data.city_name
        temp.innerHTML = `${data.temp}`
        
        let icon_url = `https://openweathermap.org/img/wn/${data.Icon}@2x.png`
        console.log(icon_url)
        weatherIcon.src = icon_url;
        humidity.innerText = `${data.Humidity}%`;
        wind.innerHTML= `${data.Wind} km/h`; 
        pressure.innerText = `${data.pressure}`; 
        today.innerText = data.TimeDate
        weather.innerText = data.Weather
    }
  }
  catch (error){
    console.log(error)
  }
}
makeRequest('Montgomery');