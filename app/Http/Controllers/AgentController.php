<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Location;
use DB;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the agents.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $agents = DB::table("agent")->get();
        $agents = Agent::All();
        return view('agents.index',compact('agents'));
    }

    /**
     * Show the form for creating a new Agent.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //todo create Agent
    }

    /**
     * Store a newly created Agent in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //todo store Agent
    }

    /**
     * Display the specified Agent.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        return view("agents.show",compact('agent'));
    }

    /**
     * Show the form for editing the specified Agent.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //todo edit Agent
    }

    /**
     * Update the specified Agent in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        //todo update Agent
    }

    /**
     * Remove the specified Agent from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //todo destroy Agent
    }
}
