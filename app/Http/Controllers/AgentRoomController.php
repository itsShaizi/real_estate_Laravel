<?php

namespace App\Http\Controllers;

class AgentRoomController extends Controller
{
    public function __invoke()
    {
        return view('backend.agent-room');
    }
}
