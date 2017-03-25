<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Coordinate;
use App\Location;
use App\Person;
use DoctrineTest\InstantiatorTestAsset\ArrayObjectAsset;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Node\Iterator;

class LoadCSVController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Load CSV Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling CSV data extraction
    | to create the initial data for locations, coordinates and contacts.
    |
    */

    /**
     * public function load chose the method to load the CSV based on type parameter
     *
     * @param Request $request
     * @param string $type fileType to load
     * @param string $filename the CSV filename
     * @param string $path the directory path for the file
     * @param string $delimiter the CSV delimiter to use with fgetcsv
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View | JsonResponse
     */
    public function load(Request $request, $type, $filename = '', $path = '', $delimiter = ''){
        switch ($type){
            case 'zipcodes':
                //setting the default filename and path for the zipcodes file.
                $filename = ($filename == '')? "zipcodes.csv" : $filename;
                $path = ($path == '')? getcwd()."/files/csv" : $path;
                $delimiter = ($delimiter == '')? ',' : $delimiter;
                try{
                    $data = array();
                    $data = $this->loadZipCodesCSV($filename,$path,$delimiter);
                    $done = false;
                    for($i = 6;$done!=true;$i++){
                        $response = $response = $this->createsCoordinatesAndLocations($data,$i);
                        $done = $response['done'];
                    }
                }catch (\Exception $e){
                    echo 'error';die;
                    if($request->isMethod("GET")){
                        return view('pages.loadingFail',array('error'=>$e->getMessage()));
                    }else{
                        return response($e->getMessage(),409);
                    }
                }
                if($request->isMethod("GET")){
                    return redirect()->route('match_agents');
                }else{
                    return json_encode(array('success'=>true));
                }
                break;

            case 'contacts':
                //setting the default filename and path for the contacts file.
                $filename = ($filename == '')? "contacts.csv" : $filename;
                $path = ($path == '')? getcwd()."/files/csv" : $path;
                $delimiter = ($delimiter == '')? ',' : $delimiter;
                try{
                    $data = array();
                    $data = $this->loadContactsCSV($filename,$path,$delimiter);
                }catch (\Exception $e){
                    if($request->isMethod("GET")){
                        return view('pages.contactsLoadingFail',array('error'=>$e->getMessage()));
                    }else{
                        return response($e->getMessage(),409);
                    }
                }
                $response = $this->createContacts($data);
                if($request->isMethod("GET")){
                    return redirect()->route('match_agents');
                }else{
                    return json_encode(array('success'=>true));
                }
                break;
            default:
                return redirect()->route('match_agents');
        }

    }


    /**
     * this function extract the contacts info from the CSV
     * @param string $filename with the pre-loaded contacts .csv filename
     * @param string $path local path to the csv pre-loaded file
     * @param string $delimiter for the csv file
     * @throws \Exception
     * @return array
     */
    private function loadContactsCSV($filename, $path, $delimiter = ','){

        $fullPath=$path.'/'.$filename;
        if(!is_dir($path)){
            throw new \Exception("Dir ". $path ." not found or doesn't exist.".PHP_EOL);
        }elseif (!file_exists($fullPath) or !is_readable($fullPath)){
            throw new \Exception("File  ". $filename ." not found or not readable in Dir " . $path . ".".PHP_EOL);
        }
        $header = NULL;
        $data = array();

        if(($handle = fopen($fullPath,'r')) !== FALSE){
            while(($row = fgetcsv($handle,1000,$delimiter)) !== FALSE){
                if (!$header){
                    foreach ($row as $item)
                        $header[]=strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', $item));
                    if (count($header)<2 or !in_array('NAME',$header) or !in_array('ZIPCODE',$header))
                        throw new \Exception($filename." file doesn't match the required headers, mandatory columns are | NAME | ZIPCODE |");
                } else {
                    $tempArrayData=array();
                    foreach ($row as $key=>$item) {
                        if($header[$key]!=='NAME' and $header[$key]!=='ZIPCODE') continue;
                        $tempArrayData[$header[$key]]=$item;
                    }
                    $data[]=$tempArrayData;
                }
            }
            fclose($handle);
        }
        return $data;
    }

    /**
     * this function extract the Coordinates and Location info
     * @param string $filename with the pre-loaded zipcodes .csv filename
     * @param string $path local path to the csv pre-loaded file
     * @param string $delimiter for the csv file
     * @throws \Exception
     * @return array
     */
    private function loadZipCodesCSV($filename, $path, $delimiter = ','){
        $fullPath=$path.'/'.$filename;
        if(!is_dir($path)){
            throw new \Exception("Dir ". $path ." not found or doesn't exist.".PHP_EOL);
        }elseif (!file_exists($fullPath) or !is_readable($fullPath)){
            throw new \Exception("File  ". $filename ." not found or not readable in Dir " . $path . ".".PHP_EOL);
        }
        $header = NULL;
        $data = array();

        if(($handle = fopen($fullPath,'r')) !== FALSE){
            while(($row = fgetcsv($handle,1000,$delimiter)) !== FALSE){
                if (!$header){
                    foreach ($row as $item)
                        $header[]=strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', $item));
                    if (!in_array('ZIPCODE',$header) or !in_array('CITY',$header) or !in_array('STATE',$header) or !in_array('LAT',$header) or !in_array('LONG',$header))
                        throw new \Exception($filename." file doesn't match the required headers, mandatory columns are | ZIPCODE | CITY | STATE | LAT | LONG |");
                } else {
                    $tempArrayData=array();
                    foreach ($row as $key=>$item) {
                        if($header[$key]!=='CITY' and $header[$key]!=='ZIPCODE' and $header[$key]!=='STATE' and $header[$key]!=='LAT' and $header[$key]!=='LONG') continue;
                        $tempArrayData[$header[$key]]=$item;
                    }
                    $data[]=$tempArrayData;
                }
            }
            fclose($handle);
        }
        return $data;
    }


    /**
     * this function creates the coordinates and locations in the database
     *
     * @param array $data with all the locations and coordinates info from the csv file
     * @param integer $i iteration number
     * @return array
     */
    private function createsCoordinatesAndLocations($data,$i){
        $errors= '';
        $count = 0;
        $lower = $i*5000;
        $upper = ($i+1)*5000;
        foreach ($data as $key=>$item) {
            if($count < $lower){
                $count++;
                continue;
            }elseif($count >=$lower and $count<$upper){
                $state = $item['STATE'];
                $city = $item['CITY'];
                $zipCode = $item['ZIPCODE'];
                $latitude = $item['LAT'];
                $longitude = $item['LONG'];
                $location = (Location::where('zipcode',$zipCode)->first()!=null)?Location::where('zipcode',$zipCode)->first():null;
                $coordinate = (Coordinate::where('latitude',$latitude)->where('longitude',$longitude)->first()!=null)?Coordinate::where('latitude',$latitude)->where('longitude',$longitude)->first():null;
                try{
                    if(!($latitude!='' and $longitude!='' and $zipCode!= '' and $city!= '' and $state!= ''))continue;
                    if($location!=null and $coordinate!= null){
                        $count++;
                        continue;
                    }
                    if(!$coordinate) {
                        /** @var Coordinate $coordinate */
                        $coordinate = new Coordinate();
                        $coordinate->latitude = $latitude;
                        $coordinate->longitude = $longitude;
                        $coordinate->save();
                    }
                    if(!$location){
                        /** @var Location $location */
                        $location = new Location();
                        $location->state = $state;
                        $location->city = $city;
                        $location->zipcode = $zipCode;
                        $coordinate->location()->save($location);
                        $location->save();
                    }

                }catch(\Exception $e){
                    $errors .= ' '.$e->getMessage();
                    continue;
                }
            }elseif($count>=$upper){
                return array('done'=>false,'errors'=>$errors);
            }
            $count++;
        }
        return array('done'=>true,'errors'=>$errors);
    }

    /**
     * this function creates the contacts in the database
     *
     * @param array $data with all the contacts info from the csv file
     * @return array
     */
    private function createContacts($data){
        $agent1 = new Agent();
        $agent1->agent_code = 'Agent1';
        $agent1->save();
        $agent2 = new Agent();
        $agent2->agent_code = 'Agent2';
        $agent2->save();
        $person1 = new Person();
        $person1->name = 'Agent1';
        $agent1->person()->save($person1);
        $person2 = new Person();
        $person2->name = 'Agent2';
        $agent2->person()->save($person2);
        $agent = Agent::find(1);
        $person1->personable_id=$agent->id;
        $person1->save();
        $agent = Agent::find(2);
        $person2->personable_id=$agent->id;
        $person2->save();
        $errors='';
        foreach ($data as $item) {
            try{
                $person = new Person();
                $person->name = $item['NAME'];
                $person->save();
                $location = Location::whereZipcode($item['ZIPCODE'])->get()->first();
                if($location==null){
                    $errors.=' '.$item['NAME'].' zipcode not found';
                    continue;
                }else{
                    $location->persons()->save($person);
                }
            }catch(\Exception $e){
                $errors .= ' '.$e->getMessage();
                continue;
            }

        }
        return array('done'=>true,'errors'=>$errors);
    }
}
