<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Models\DonationPoint;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class NotificationRepository
{
    protected $user,$donation;

    public function __construct(User $user, DonationPoint $donation)
    {
        $this->user=$user;
        $this->donation=$donation;

    }

    public function list()
    {
       // return $this->city->with('country')->get();
    }

    public function CreateNotification($notification, $userCreate, $userNotificate)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $firebaseToken = $this->user::find($userNotificate);

       
        $notificacion=[
            'user_create'=> $userCreate, //Auth::user()->id,
            'user_notificate'=> $userNotificate,
            'date_create'=>Carbon::now(),
            'note'=>$notification,
            'status'=>true,

        ];
        //$this->notifications::create($notificacion);


        $SERVER_API_KEY = 'AAAAs2RSSEg:APA91bHwFvaKa1N1p3leQTW41H6OLZ-uY7tZb4POwbN6FVFkyFM529TyZiRgUIN1qrLWgq5rJ3dgUfZpM7qg1r46t2ozz97X_77H-suvHap6W5f_lYePwetA6xutl8pyLYLwJ0ipgQ7U';

        $data = [
            "registration_ids" =>[isset ($firebaseToken->device_token) == false ? '' : $firebaseToken->device_token] ,
            "notification" => [
                "title" => "SiDono",
                "body" => $notification,
                "content_available" => true,
                "priority" => "high",
            ]
        ];

        $encodedData = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        $response = curl_exec($ch);

        dd($response);
        //return $result;
    }

   
    public function show($id)
    {
       
    }

}