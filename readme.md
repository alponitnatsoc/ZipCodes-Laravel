

## <p align="center">Welcome to zipCodes project using laravel</p>

## About ZipCodes Project

This is a simple web application to match agents with contacts based on zip codes location, given a list of contacts each one with zip code and the location of each agent, the web app matches the contacts with the nearliest agent.

## About the solution

To achieve the main goal of this project, it´s necessary to consider how to obtain the distance between two zip codes, there´s a lot of web services and apps that can make this. The simple way is that having the longitude and latitude of each zip code then the distance between them is easily calculated mathematically

First of all, we need a database with the information of longitude and latitude of all postal codes; For this project we will only focus on the postal codes of United States, but works the same for any country. The database used can be found in this [link](http://federalgovermentzipcodes.us), and we use only the longitude and latitud columns of the __"Primary locations only" 4.2MB file__. 

Second we need to calculate the distance between to zip codes, the shortest distance between two points over the surface of the earth is calculated with the __haversine formula__ ([¿what is the haversine formula?](https://en.wikipedia.org/wiki/Haversine_formula)), the math formula is: 

![haversine formula](https://wikimedia.org/api/rest_v1/media/math/render/svg/47a496cca1b6d57e0ae7b462c1678660392d1057)

where: 
- __*hav*__ is the haversine function:
- __*d*__ is the distance between the two points (along a great circle of the sphere),
- __*r*__ is the radius of the sphere,
- __*φ1, φ2*__: latitude of point 1 and latitude of point 2, in radians
- __*λ1, λ2*__: longitude of point 1 and longitude of point 2, in radians

But theres already a lot of bundles that do this for us, in every units system, so we will be using one of them.
