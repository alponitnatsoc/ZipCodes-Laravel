<?php

namespace App\Http\Controllers;

use App\Coordinate;
use Illuminate\Http\Request;
use League\Geotools\Coordinate\CoordinateCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ZipCodeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Zip Code Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling CRUD for Coordinates and Locations
    |
    */

    protected $coordinates;

    public function __construct(CoordinateCollection $coordinates)
    {
        $this->coordinates = $coordinates;
    }



    public function createCoordinate(Requecst $request,$latitude,$longitude){
        $coordinates = Coordinate::where('latitude',$latitude)->where('longitude',$longitude);
        if($coordinates->count()!=0){
            echo "ya esxite";
        }else{
            echo "yay";
        }

    }

    public function createLocation(Request $request, $zipCode, $state, $city, $coordId){
        if(Coordinate::find($coordId)!=null){
            $coordinate = Coordinate::find($coordId);
        }else{
            throw new NotFoundHttpException();
        }

    }
}
