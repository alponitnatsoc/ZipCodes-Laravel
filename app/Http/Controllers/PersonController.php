<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the Persons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //todo show all persons
    }

    /**
     * Show the form for creating a new Person.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //todo create person
    }

    /**
     * Store a newly created Person in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //todo store person
    }

    /**
     * Display the specified Person.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //todo show person
    }

    /**
     * Show the form for editing the specified Person.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //todo edit person
    }

    /**
     * Update the specified Person in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //todo update person
    }

    /**
     * Remove the specified Person from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //todo destroy person
    }

    /**
     * Display all contacts if no agent or all agent contacts if agent.
     * @param Agent |null $agent
     * @return \Illuminate\Http\Response
     */
    public function showContacts(Agent $agent = null)
    {
        if($agent->contacts()->count()!=0)
            return view('contacts.showContacts',array('contacts'=>$agent->contacts));
        $persons = Person::wherePersonableId(null)->get();
        return view('contacts.showContacts',array('contacts'=>$persons));
    }
}
