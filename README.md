<p align="center">
    <h1 align="center">Symfony 5 Based test</h1>
    <br/>
</p>

This is basic [Symfony](https://symfony.com/) test application that allow's you to get current weather data based on your IP or overrided IP in .env file

### Installation

1) Copy .env.example to .env
2) Edit .env varibales `IP_OVERRIDE` `IPSTACK_ACCESS_KEY` `OPEN_WEATHER_ACCESS_KEY`
3) Install composer dependecies
~~~
composer install
~~~
4) Install node packages & build it
~~~
npm install & npm run build
~~~
5) Run local server
6) Access web app using `php -S localhost:8000 -t public/`
