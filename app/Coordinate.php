<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Coordinate
 *
 * @property int $id
 * @property float $latitude
 * @property float $longitude
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Location[] $location
 * @method static \Illuminate\Database\Query\Builder|\App\Coordinate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coordinate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coordinate whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coordinate whereLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coordinate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Coordinate extends Model
{


    protected $table = 'coordinate';

    protected $fillable = ['latitude','longitude'];

    public function location(){
        return $this->hasMany('App\Location');
    }


}
