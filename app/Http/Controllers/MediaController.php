<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Models\Media;
use App\Services\Facades\MediaFacade as MediaService;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Media::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request)
    {
        $this->authorize('create', Media::class);
       
        if ($request->hasFile('video')) {

            $fileVideo = $request->file('video')->getClientOriginalName();

            $storagePath = 'uploads/video';

            $videoPath = $request->file('video')->storeAs($storagePath, $fileVideo);

            FFMpeg::fromDisk('local')->open($storagePath . '/' . $fileVideo)
                ->export()
                ->addFilter(function ($filters) {
                    $filters->resize(new \FFMpeg\Coordinate\Dimension(140, 80));
                })
                ->inFormat(new \FFMpeg\Format\Video\X264)
                ->onProgress(function ($percentage) {
                    dd("{$percentage}% transcoded");
                });
        };
        
        if ($request->hasFile('audio')) {

            $fileAudio = $request->file('audio')->getClientOriginalName();

            $storagePath = 'uploads/audio';

            $audioPath = $request->file('audio')->storeAs($storagePath, $fileAudio);

            FFMpeg::fromDisk('local')
                ->open($storagePath . '/' . $fileAudio)
                ->export()
                ->inFormat(new \FFMpeg\Format\Audio\Aac);
                
        };
        if ($request->hasFile('image')) {

            $fileImage  = $request->file('image')->getClientOriginalName();

            $imagePath =  $request->file('image')->storeAs('uploads/image', $fileImage);
        }

        $media = new Media();

        $media->url_image = $imagePath;
        $media->url_video = $videoPath;
        $media->url_audio = $audioPath;
        $media->texte = $request->texte;
        $media->save();

        return $media;
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        //
    }
}
