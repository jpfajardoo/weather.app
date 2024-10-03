<h1>Weather App</h1>
<p>A weather forecast web application built using Laravel, MySQL, Vue.js with Inertia.js, OpenWeatherMap API, and Geoapify API. This app allows users to search for weather information based on location data.</p>

<h2>Table of Contents</h2>
<ul>
    <li><a href="#features">Features</a></li>
    <li><a href="#technologies-used">Technologies Used</a></li>
    <li><a href="#prerequisites">Prerequisites</a></li>
    <li><a href="#installation">Installation</a></li>
    <li><a href="#environment-variables">Environment Variables</a></li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#api-integration">API Integration</a></li>
    <li><a href="#license">License</a></li>
</ul>

<h2 id="features">Features</h2>
<ul>
    <li>Search for current weather conditions based on city name.</li>
    <li>Display weather information such as temperature, humidity, wind speed, etc.</li>
    <li>Retrieve location data using Geoapify API.</li>
    <li>Real-time weather updates using OpenWeatherMap API.</li>
    <li>User-friendly interface built with Vue.js, Inertia.js and Tailwind CSS.</li>
</ul>

<h2 id="technologies-used">Technologies Used</h2>
<ul>
    <li><strong>Backend:</strong> Laravel</li>
    <li><strong>Frontend:</strong> Vue.js with Inertia.js, Tailwind CSS</li>
    <li><strong>Database:</strong> MySQL</li>
    <li><strong>APIs:</strong> OpenWeatherMap and Geoapify</li>
</ul>

<h2 id="prerequisites">Prerequisites</h2>
<ul>
    <li>PHP 8.3+</li>
    <li>Composer</li>
    <li>Node.js and npm</li>
    <li>MySQL</li>
    <li>OpenWeatherMap API Key</li>
    <li>Geoapify API Key</li>
</ul>

<h2 id="installation">Installation</h2>
<ol>
    <li>Clone the repository:
        <pre><code>git clone https://github.com/jpfajardoo/weather.app.git
cd weather-app</code></pre>
    </li>
    <li>Install dependencies:
        <pre><code>composer install
npm install</code></pre>
    </li>
    <li>Set up the environment file:
        <pre><code>cp .env.example .env</code></pre>
    </li>
    <li>Generate application key:
        <pre><code>php artisan key:generate</code></pre>
    </li>
    <li>Configure the database in your <code>.env</code> file:
        <pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password</code></pre>
    </li>
    <li>Run migrations:
        <pre><code>php artisan migrate</code></pre>
    </li>
    <li>Build frontend assets:
        <pre><code>npm run dev</code></pre>
    </li>
    <li>Run the application:
        <pre><code>php artisan serve</code></pre>
    </li>
</ol>

<h2 id="environment-variables">Environment Variables</h2>
<p>Make sure to add your API keys to the <code>.env</code> file:</p>
<pre><code>OPENWEATHER_API_KEY=your_openweathermap_api_key
GEOAPIFY_API_KEY=your_geoapify_api_key</code></pre>

<h2 id="usage">Usage</h2>
<ol>
    <li>Visit the application in your browser at <code>http://localhost:8000</code>.</li>
    <li>Enter a city name or use the location services to get weather data for a specific place.</li>
    <li>View the weather forecast, including temperature, humidity, wind speed, etc.</li>
</ol>

<h2 id="api-integration">API Integration</h2>
<h3>OpenWeatherMap API</h3>
<p>The app fetches weather information from OpenWeatherMap's API. You can check the <a href="https://openweathermap.org/api">OpenWeatherMap API documentation</a> for details on how to configure and use the API.</p>

<h3>Geoapify API</h3>
<p>Geoapify is used to handle geocoding and reverse geocoding, allowing users to search for locations by name. Visit the <a href="https://www.geoapify.com/developers">Geoapify documentation</a> for more information.</p>

<h2 id="license">License</h2>
<p>This project is licensed under the MIT License. See the <a href="LICENSE">LICENSE</a> file for details.</p>