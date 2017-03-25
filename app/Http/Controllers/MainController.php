<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Coordinate;
use App\Location;
use App\Person;
use Geotools;
use Illuminate\Http\Request;
use App\Traits\GeotoolsTrait;

class MainController extends Controller
{
    use GeotoolsTrait;

    /**
     * Automatically redirects to match_agents route when no route is specified
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showIndex(){
        return redirect()->route("match_agents");
    }

    public function match(){
        if(Location::all()->count()==0)
            return redirect()->route('loading_zip_codes');
        if(Person::wherePersonableId(null)->get()->count()==0)
            return redirect()->route('loading_contacts');
        return view('pages.matchAgents');
    }

    public function matchProcess(Request $request){

        $locations = array();
        //retrieving the locations from the zip codes in request
        $locations[] = Location::whereZipcode($request->zipCode1)->get()->first();
        $locations[] = Location::whereZipcode($request->zipCode2)->get()->first();

        //checking that the locations were found
        if($locations[0] == null or $locations[1] == null)
            return "error";
        //cheking locations are different
        if($locations[0]->zipcode == $locations[1]->zipcode)
            return "error";
        try{
            if($this->updateAgentsLocation($locations)){
                $this->matchContacts();
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
        $contacts = Person::wherePersonableId(null)->get();
        return view('pages.results',compact('contacts'));
    }

    /**
     * Updates agents locations
     *
     * @param array $locations
     * @return bool
     * @throws \Exception
     */
    private function updateAgentsLocation($locations){

        $agents = Agent::all();
        if(count($locations)!=$agents->count())
            throw  new \Exception('Not enoguth agents or locations');
        /** @var Agent $agent */
        foreach ($agents as $key=>$agent) {
            $locations[$key]->persons()->save($agent->person);
        }
        return true;
    }

    /**
     * Matches contacs with agents by shortest distance between them
     * @return bool
     */
    private function matchContacts(){
        //getting all the contacts
        $contacts = Person::wherePersonableId(null)->get();
        // getting the agents
        $agent1 = Agent::find(1);
        $agent2 = Agent::find(2);
        //creating the Geotools Coordinates
        /** @var Coordinate $coord1 */
        $coord1 = $agent1->person->location->coordinate;
        /** @var Coordinate $coord2 */
        $coord2 = $agent2->person->location->coordinate;
        foreach ($contacts as $contact) {
            $coord3 = $contact->location->coordinate;
            $distance1 = $this->getDistance($coord1,$coord3);
            $distance2 = $this->getDistance($coord2,$coord3);
            if($distance1<$distance2){
                $agent1->contacts()->save($contact);
            }else{
                $agent2->contacts()->save($contact);
            }
        }
        return true;
    }

}
