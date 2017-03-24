<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Coordinate
 *
 * @property int $id
 * @property float $latitude
 * @property float $longitude
 * @property-read \App\Location $location
 * @method static \Illuminate\Database\Query\Builder|\App\Coordinate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coordinate whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coordinate whereLongitude($value)
 * @mixin \Eloquent
 */
class Coordinate extends Model
{


    protected $table = 'coordinate';

    protected $fillable = ['latitude','longitude'];

    public function location(){
        return $this->hasOne('App\Location');
    }


}
