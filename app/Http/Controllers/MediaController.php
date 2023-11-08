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
     * @OA\Get(
     *     path="/api/upload",
     *      operationId="indexxx",
     *      tags={"Media"},
     *      summary="Get media",
     *      description="Get media",
     * security={{"bearerAuth": {{}}}},
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage des medias."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     *  * @OA\response(
     *      response=401,
     * description="Unauthorized"
     * ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function index()
    {
        return Media::all();
    }

     /**
     * @OA\Post(
     *      path="/api/upload",
     *      operationId="storeee",
     *      tags={"Media"},
     *      summary="upload files",
     *      description="upload files",
     * security={{"bearerAuth": {{}}}},
     *      @OA\RequestBody(
     *      required=true,
     *      description="Telechargement des fichiers",
     * 
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *      @OA\Property(property="image", type="file", format="image", example="https://image.png", description ="image de votre challenge"),   
     *      @OA\Property(property="video", type="file", format="video", example="https://video.mp4", description ="video de votre challenge"),   
     *      @OA\Property(property="audio", type="file", format="audio", example="https://audio.mp3", description ="audio de votre challenge"),   
     *      @OA\Property(property="texte", type="string", format="string", example="skdjfdkjf soidjfd sidj", description ="votre texte d'evennement"),   
     *  )
     *        ),
     *      ),
     *    @OA\Response(
     *      response=200,
     *      description="success",
     *      @OA\JsonContent(
     *      @OA\Property(property="imagePath", type="string", example="uploads/images/ghRfjbiJHOvnMBaeerGTwCbYxV0WEnRuRPFod9N3.jpg"),
     *      @OA\Property(property="videoPath", type="string", example="uploads/videos/ghRfjbiJHOvnMBaeerGTwCbYxV0WEnRuRPFod9N3.jpg"),
     *      @OA\Property(property="audioPath", type="string", example="uploads/audios/ghRfjbiJHOvnMBaeerGTwCbYxV0WEnRuRPFod9N3.jpg"),
     * @OA\Property(property="texte", type="string", example="ejdwiej oidjidhf uhfdjfv ",
     *
     *        
     * )
     *     ),
     *    @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     *  * @OA\response(
     *      response=401,
     * description="Unauthorized"
     * ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
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
