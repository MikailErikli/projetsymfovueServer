const weatherIcons = {
    "Rain": "wi wi-day-rain",
    "Clouds": "wi wi-day-cloudy",
    "Clear": "wi wi-day-sunny",
    "Snow": "wi wi-day-snow",
    "mist": "wi wi-day-fog",
    "Drizzle": "wi wi-day-sleet",
}

function capitalize(str){
    return str[0].toUpperCase() + str.slice(1);
}


function main(){
     fetch('http://api.ipify.org?format=json')
    .then(resultat => resultat.json())
         .then(json => {
             const ip = json.ip;

             fetch('https://freegeoip.net/json/' +ip)
                 .then(resultat => resultat.json())
                 .then(json => {
                     const ville = json.city;
                     fetch('api.openweathermap.org/data/2.5/weather?q=${ville}&appid=fe567942eb919c65c1e3ed7265ffa8a4')
                         .then(resultat)
                 })
         })


}