<?php
/**
 * Created by PhpStorm.
 * User: andresfeliperamirezbonilla
 * Date: 3/24/17
 * Time: 8:31 PM
 */

namespace App\Traits;

use App\Coordinate;
use Geotools;

trait GeotoolsTrait
{

    /**
     * Creates a Geotool Coordinate form latitude and longitude
     *
     * @param float $latitude
     * @param float $longitude
     * @return \Toin0u\Geotools\Coordinate
     */
    public function createCoordinate($latitude, $longitude){
        return Geotools::coordinate([$latitude,$longitude]);
    }

    /**
     * Creates a Geotool Coordinate form an App\Coordinate
     *
     * @param Coordinate $coordinate
     * @return \Toin0u\Geotools\Coordinate
     */
    public function getCoordinate(Coordinate $coordinate)
    {
        return Geotools::coordinate([$coordinate->latitude,$coordinate->longitude]);
    }


    /**
     * returns distance between two coordinates
     * @param Coordinate $coordinate1
     * @param Coordinate $coordinate2
     * @return mixed
     */
    public function getDistance(Coordinate $coordinate1, Coordinate $coordinate2){
        /** @var \Toin0u\Geotools\Coordinate $coord1 */
        $coord1 = $this->getCoordinate($coordinate1);
        /** @var \Toin0u\Geotools\Coordinate $coord2 */
        $coord2 = $this->getCoordinate($coordinate2);
        return floatval(Geotools::distance()->setFrom($coord1)->setTo($coord2)->in('Km')->haversine());
    }


}