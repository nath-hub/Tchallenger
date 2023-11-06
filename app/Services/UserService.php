<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserDelete;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserService
{

    /**
     * Create a user
     * 
     * @param array $input The user data
     * 
     * @return string The newly created data of the user
     */
    public function store($input)
    {
        $input['password'] = Hash::make($input['password']);

        $state = User::create($input);

        $code = random_int(99999, 999999);

        // $lieu = asset('/api/update-verification-email/');

        // Mail::send('mail', ['id' => $state->id, "code" => $code], function ($message) use ($input) {
        //     $message->to($input['email']);
        //     $message->subject("E-mail de validation");
        // });

        return $state;
    }

    /**
     * show a user
     * 
     * @param array $user The user data
     * 
     */
    public function view($user)
    {
        return $user;
    }

    /**
     * update a user
     * 
     * @param array $user The user data
     * 
     */
    public function update(array $user, $input)
    {
        $state = $user->update($input);

        return $state;
    }


    public function sendEmail($user, $input)
    {

        $user = User::where('email', $input['email'])->get();

        if (isset($user)) {

            $email = $user[0]->email;

            $lieu = asset('/');

            Mail::send('mailVerification', ['verify' => $user[0]->id, 'lieu' => $lieu], function ($message) use ($email) {
                $message->to($email);
                $message->subject("E-mail de verification");
            });

            return [
                "statut" => 200, "data" => $user
            ];
        }
        return [];
    }

    public function verification($user)
    {

        $user->email_verified_at = Carbon::now();

        $user->update();
    }

    /**
     * Upload user avatar
     * 
     * @param UploadedFile $avatarFile The avatar file
     * 
     * @return array
     */
    public function uploadAvatar(UploadedFile $avatarFile): array
    {

        $avatarPath = $avatarFile->store('users/avatar', 'public');

        return [
            'avatar_path' => $avatarPath,
            'avatar_url' => asset($avatarPath),
        ];
    }

    /**
     * Update a user
     * 
     * @param User $user the a user who updates his password
     * @param array $input The user data
     * 
     */
    public function updatePassword($dataToUpdate, $user)
    {

        if (isset($dataToUpdate['password'])) {
            $dataToUpdate['password'] = Hash::make($dataToUpdate['password']);
        }

        $user->update($dataToUpdate);

        return response()->json([], 204);
    }


    /**
     * Delete a user
     * 
     * @param array $input The user id
     * 
     * @return void
     */
    public function delete($userToDelete)
    {

        $user = new UserDelete();
        $user->login = $userToDelete['login'];
        $user->phone = $userToDelete['phone'];
        $user->email = $userToDelete['email'];
        $user->code = $userToDelete['code'];
        $user->active = $userToDelete['active'];
        $user->phone = $userToDelete['phone'];
        $user->avatar = $userToDelete['avatar'];
        $user->password = $userToDelete['password'];
        $user->email_verified_at = $userToDelete['email_verified_at'];
        $user->derniereConnexion = $userToDelete['derniereConnexion'];
        $user->date_delete = Carbon::now();

        $user->save();

        return $userToDelete->delete();
    }
}
