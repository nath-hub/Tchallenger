<?php

namespace App\Services;

use App\Models\Parameter;
use Illuminate\Support\Facades\Auth;


class ParameterService
{

    public function create($input)
    {

        $user = Auth::user();

        $input["user_id"]= $user->id;
        
        $state = Parameter::create($input);

        return $state;
    }


    public function view($parameter)
    {
        return Parameter::find($parameter);

    }

    public function update($parameterToUpdate, $input)
    {
        $state = $parameterToUpdate->update($input);

        return $state;
    }

    public function delete($parameter)
    {
        $state = $parameter->delete();

        return $state;
    }
}
