<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use App\Models\Parameter;
use App\Services\Facades\ParameterFacade as ParameterService;
use Illuminate\Support\Facades\Auth;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return Parameter::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreParameterRequest  $request
     * @return string
     */
    public function store(StoreParameterRequest $request)
    {
        $this->authorize('create', Parameter::class);

        $input = $request->validated();

        $data = ParameterService::create($input);

        return  $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parameter  $parameter
     * @return string
     */
    public function show(Parameter $parameter)
    {        
        $user = Auth::user();

        $this->authorize("view",  [$user, $parameter]);

        $data = ParameterService::view($parameter);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParameterRequest  $request
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParameterRequest $request, Parameter $parameter)
    {
        $user = Auth::user();

        $this->authorize('update', [$user, $parameter]);

        $input = $request->validated();

        $data = ParameterService::update($parameter, $input);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter $parameter)
    {
        $user = Auth::user();

        $this->authorize('delete', [$user, $parameter]);

        $data = ParameterService::delete($parameter);

        return $data;
    }
}
