import { ref } from 'vue';

export function useWeatherService() {
    const weather = ref({
        temp: '',
        feelsLike: '',
        windSpeed: '',
        windGust: '',
        humidity: '',
        description: '',
        icon: ''
    });

    const forecast = ref([]);
    const isLoading = ref(false);

    const fetchWeatherData = async (address, lat, lon) => {
        isLoading.value = true;
        try {
            const weatherResponse = await fetch(`/weather?time=weather&lat=${lat}&lon=${lon}&address=${address}`);
            const weatherData = await weatherResponse.json();
            weather.value.temp = Math.round(weatherData.main.temp);
            weather.value.feelsLike = Math.round(weatherData.main.feels_like);
            weather.value.windSpeed = weatherData.wind.speed ? Math.round(weatherData.wind.speed * 3.6) : '';
            weather.value.windGust = weatherData.wind.gust ? Math.round(weatherData.wind.gust * 3.6) : '';
            weather.value.humidity = weatherData.main.humidity ? Math.round(weatherData.main.humidity) : '';
            weather.value.description = weatherData.weather[0].description;
            weather.value.icon = weatherData.weather[0].icon;
        } catch (error) {
            console.log('error', error);
        } finally {
            isLoading.value = false;
        }
    };

    const fetchWeatherForecast = async (address, lat, lon, limit) => {
        isLoading.value = true;
        try {
            const weatherResponse = await fetch(`/weather?time=forecast&lat=${lat}&lon=${lon}&address=${address}`);
            const weatherData = await weatherResponse.json();
console.log(weatherData);
            const currentDateTime = new Date();
            // Filter the forecast for times in the future and get the first n limit
            forecast.value = weatherData.list.filter(item => new Date(item.dt_txt) >= currentDateTime).slice(0, limit);
        } catch (error) {
            console.log('error', error);
        } finally {
            isLoading.value = false;
        }
    };

    return { weather, forecast, isLoading, fetchWeatherData, fetchWeatherForecast };
}