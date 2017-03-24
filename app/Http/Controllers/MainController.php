<?php

namespace App\Http\Controllers;

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
}
