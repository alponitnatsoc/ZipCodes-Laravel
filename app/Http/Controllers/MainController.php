<?php

namespace App\Http\Controllers;

use App\Coordinate;
use App\Location;
use App\Person;
use Geotools;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Automatically redirects to match_agents route when no route is specified
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showIndex(){
        return redirect()->route("match_agents");
    }

    public function match(){
        if(Person::wherePersonableId(null)->get()->count()==0)
            return redirect()->route('loading');
        return view('pages.matchAgents');
    }

    public function matchProcess(Request $request){


        $contacts = Person::wherePersonableId(null)->get();
        dump($contacts);die;

        $coord1 = Geotools::coordinate([32.29,-110.83]);
        $coord2 = Geotools::coordinate([33.76,-112.24]);
        $distance = Geotools::distance()->setFrom($coord1)->setTo($coord2);
        echo $distance->in('Km')->haversine();

        return view('pages.matchAgents');
    }
}
