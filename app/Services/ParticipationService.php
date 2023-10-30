<?php

namespace App\Services;

use App\Models\Participation;
use Illuminate\Support\Facades\Auth;


class ParticipationService
{

    public function store($input)
    {

        $state = Participation::create($input);

        return $state;
    }

    public function vote(){
        
    }

    public function view($participation)
    {
        return [$participation->post, $participation->getAttributes()];
    }

    public function update(Participation $participation,  $dataToUpdate)
    {
        return $participation->update($dataToUpdate);
    }

    public function delete($participation)
    {
        return $participation->delete();
    }
}
