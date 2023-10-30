<?php

namespace App\Services;

use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class ActionService
{

    public function store($input)
    {
        $user = Auth::user();

        $input["user_id"] = $user->id;

        $state = Action::create($input);

        return $state;
    }

    public function view($action)
    {
        $action->load("user_action", "participations_action");

        return [$action->participations_action, $action->getAttributes()];
    }
}
