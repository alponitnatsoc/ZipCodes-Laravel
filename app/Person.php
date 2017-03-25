<?php

namespace App;


use Illuminate\Database\Eloquent\Model;



/**
 * App\Person
 *
 * @property int $id
 * @property int $agent_id
 * @property int $location_id
 * @property string $name
 * @property int $personable_id
 * @property string $personable_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Agent $agent
 * @property-read \App\Location $location
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $personable
 * @method static \Illuminate\Database\Query\Builder|\App\Person whereAgentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Person whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Person whereLocationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Person whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Person wherePersonableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Person wherePersonableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Person whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Person extends Model
{
    protected $table = 'person';

    protected $fillable = ['name'];

    public function location(){
        return $this->belongsTo('App\Location');
    }

    public function agent(){
        return $this->belongsTo('App\Agent');
    }

    public function personable(){
        return $this->morphTo();
    }

}
