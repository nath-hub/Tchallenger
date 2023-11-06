<?php

namespace App\Services;

use App\Http\Requests\StoreMediaRequest;
use App\Models\Media;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class MediaService
{
    public function store(StoreMediaRequest $request)
    {
        if ($request->hasFile('video')) {

            $fileVideo = $request->file('video')->getClientOriginalName();

            $storagePath = 'uploads/video';

            $converet = 'convertis';

            $videoPath = $request->file('video')->storeAs($storagePath, $fileVideo);

            FFMpeg::fromDisk('local')->open($storagePath . '/' . $fileVideo)
                ->export()
                ->addFilter(function ($filters) {
                    $filters->resize(new \FFMpeg\Coordinate\Dimension(140, 80));
                })
                ->toDisk($converet)
                ->inFormat(new \FFMpeg\Format\Video\X264)
                ->onProgress(function ($percentage) {
                    dd("{$percentage}% transcoded");
                })->save($videoPath);
        };
        if ($request->hasFile('audio')) {

            $fileAudio = $request->file('audio')->getClientOriginalName();

            $storagePath = 'uploads/audio';

            $audioPath = $request->file('audio')->storeAs($storagePath, $fileAudio);

            FFMpeg::fromDisk('local')
                ->open($storagePath . '/' . $fileAudio)
                ->export()
                ->inFormat(new \FFMpeg\Format\Audio\Aac)->save($audioPath);
                
        };
        if ($request->hasFile('image')) {

            $fileImage  = $request->file('image')->getClientOriginalName();

            $imagePath =  $request->file('image')->storeAs('uploads/image', $fileImage);
        }



        return [$videoPath, $audioPath, $imagePath];
    
    }
}