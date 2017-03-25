

## Welcome to zipCodes project using laravel

## About ZipCodes Project

This is a simple web application to match agents with contacts based on zip codes location, given a list of contacts each one with zip code and the location of each agent, the web app matches the contacts with the nearliest agent.

## About the solution

To achieve the main goal of this project, it´s necessary to consider how to obtain the distance between two zip codes, there´s a lot of web services and apps that can make this. The simple way is that having the longitude and latitude of each zip code then the distance between them is easily calculated mathematically

First of all, we need a database with the information of longitude and latitude of all postal codes; For this project we will only focus on the postal codes of United States, but works the same for any country. The database used can be found in this [link](http://federalgovernmentzipcodes.us), and we use only the longitude and latitud columns of the __"Primary locations only" 4.2MB file__. 

Second we need to calculate the distance between to zip codes, the shortest distance between two points over the surface of the earth is calculated with the "__*haversine formula*__": 

![haversine formula](https://wikimedia.org/api/rest_v1/media/math/render/svg/47a496cca1b6d57e0ae7b462c1678660392d1057)

where: 
- __*hav*__ is the haversine function:
- __*d*__ is the distance between the two points (along a great circle of the sphere),
- __*r*__ is the radius of the sphere,
- __*φ1, φ2*__: latitude of point 1 and latitude of point 2, in radians
- __*λ1, λ2*__: longitude of point 1 and longitude of point 2, in radians

for more info about the haversine formula go to this [link](https://en.wikipedia.org/wiki/Haversine_formula)

But theres already a lot of bundles that do this for us, in every units system, so we will be using one of them.
The package we are using is __*toin0u/geotools-laravel*__ you can find more info about it on the official repository link:  [toin0u/geotools-laravel](https://github.com/toin0u/Geotools-laravel).

I decided to use this package after compare it with some other packages like the [jeroendesloovere/distance](https://github.com/jeroendesloovere/distance) and [ns/distance-bundle](https://github.com/NobletSolutions/DistanceBundle), my test included time and accuracy between the result given by the packages, in miles and Kilometers, compared to the results given by the web apps [melisadata](https://www.melisadata.com/lookups/zipdistance.app),  [freemaptools](https://www.freemaptools.com/distance-between-usa-zip-codes.htm) and [zipcodeapi](https://www.zipcodeapi.com/API#distance). 

## About packages

Since this is a laravel project, I installed barryvdh/laravel-ide-helper in order to make development easier using IDE including all the required packages to make it works, like the doctrine/dbal package, in other hand also the previous mentioned package that gets the distance between two coordinates toin0u/geotools-laravel.


## Installation notes

Before using this repository, be sure to have installed all the laravel 5.4 server requirements.
- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

also I recommend develop in linux or OSX environment.
For more about the installation proccess of laravel visit the [laravel documentation](https://laravel.com/docs/5.4/installation)

## Set up the database

For the initial configuration call the following commands inside the project directory: 

    composer install 
    composr update
    npm install 
    npm update
    npm install -dev
    npm update -dev
    npm run dev
    
__note: you need composer and nodejs to be properly installed and configured to be called globally__

then configure your local *.env* file with the database connections parameters and execute 
    
    php artisan serve
    
this should initialize the local server, in another command prompt or terminal run:

    php artisan migrate 

this should create the required tables into your database. To load all the zipCodes and contacts info, go to the default route of you server [http://127.0.0.1:8000](http://127.0.0.1:8000)

you should see something like this:

![loading](http://i.imgur.com/xNuzXAy.png)
