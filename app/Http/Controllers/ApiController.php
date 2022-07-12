<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PeopleAndPlanet;
use Illuminate\Support\Facades\DB;



class ApiController extends Controller
{

    function list(Request $request) {
       
        $page = 1;
        $data = array();
        while($page <=9){
            $pageConvert = strval($page);
            $people = Http::get("https://swapi.dev/api/people?page=".$pageConvert)->json();


            for($x = 0; $x < count($people["results"]); $x++){
                $planetURL = $people["results"][$x]["homeworld"];

                $planetSpec = Http::get($planetURL)->json();
                $people["results"][$x]["homeworld"] = $planetSpec;

  
                $peopleAndPlanet = new PeopleAndPlanet;
                $peopleAndPlanet->name=$people["results"][$x]["name"];
                $peopleAndPlanet->height=$people["results"][$x]["height"];
                $peopleAndPlanet->mass=$people["results"][$x]["mass"];
                $peopleAndPlanet->hair_color=$people["results"][$x]["hair_color"];
                $peopleAndPlanet->skin_color=$people["results"][$x]["skin_color"];
                $peopleAndPlanet->eye_color=$people["results"][$x]["eye_color"];
                $peopleAndPlanet->birth_year=$people["results"][$x]["birth_year"];
                $peopleAndPlanet->gender=$people["results"][$x]["gender"];
                $peopleAndPlanet->homeworld=json_encode($people["results"][$x]["homeworld"]);
                $peopleAndPlanet->films=json_encode($people["results"][$x]["films"]);
                $peopleAndPlanet->species=json_encode($people["results"][$x]["species"]);
                $peopleAndPlanet->vehicles=json_encode($people["results"][$x]["vehicles"]);
                $peopleAndPlanet->starships=json_encode($people["results"][$x]["starships"]);
                $peopleAndPlanet->url=json_encode($people["results"][$x]["url"]);
                $peopleAndPlanet->save();
            };
                array_push($data,$people);
                $page++;
            }
        
            
        return $data;
    }

    function people() {
        $users = DB::table('people_and_planets')->select('id','name','mass','hair_color', 'skin_color', 'eye_color', 'birth_year', 'gender', 'homeworld', 'films', 'species', 'vehicles', 'starships', 'url', 'created_at', 'updated_at')->paginate(20);

        return $users;
    }


    function peopleSelect($peopleid) {
        
        $users = DB::table('people_and_planets')->select('id','name','mass','hair_color', 'skin_color', 'eye_color', 'birth_year', 'gender', 'homeworld', 'films', 'species', 'vehicles', 'starships', 'url', 'created_at', 'updated_at')->where('id', $peopleid)->get();

        return $users;
    }
}
