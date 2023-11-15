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

    public function CreateNotificationUser($notification, $userNotificate)
    {
        $firebaseToken = $this->user::find($userNotificate);


        $data = [
            "registration_ids" =>$firebaseToken->device_token,
            "notification" => [
                "title" => "SiDono",
                "body" => $notification,
                "content_available" => true,
                "priority" => "high",
            ]
        ];

        $this->notificacion($data);
    }
    public function CreateNotificationAllUser($notification,$dataNotif)
    {
        $firebaseToken = $this->user::whereNotNull('device_token')->pluck('device_token')->all();

        $data = [
            "registration_ids" =>$firebaseToken,
            "notification" => [
                "title" => "SiDono",
                "body" => $notification,
                "content_available" => true,
                "priority" => "high",
            ],
            'data' => $dataNotif
        ];

        $this->notificacion($data);
    }
    public function CreateNotificationCountry($notification,$country,$dataNotif)
    {
        $firebaseToken = $this->user::whereNotNull('device_token')->where('country',$country)
            ->pluck('device_token')->all();


        $data = [
            "registration_ids" =>$firebaseToken,
            "notification" => [
                "title" => "Convocatoria para donar sangre",
                "body" => $notification,
                "content_available" => true,
                "priority" => "high",
            ],
            'data' => $dataNotif
        ];

        $this->notificacion($data);
    }

    public function NotificationBirthday()
    {
        $firebaseToken = $this->user::whereNotNull('device_token')
                ->whereMonth('date_birth',Carbon::now()->format('m'))
                ->whereDay('date_birth',Carbon::now()->format('d'))
                ->pluck('device_token')->all();


        $data = [
            "registration_ids" =>$firebaseToken,
            "notification" => [
                "title" => "SiDono",
                "body" =>"Feliz Cumpleaños te desea la Cruz Roja",
                "content_available" => true,
                "priority" => "high",
            ]
        ];

        $this->notificacion($data);
    }

    public function NotificationSchedule()
    {
        $firebaseToken = $this->user::whereNotNull('device_token')
                ->whereHas('scheduleDonor', function($q)  {
                    $q->where("donation_date",Carbon::now()->subDay(3)->format('Y-m-d'))->where('status',true);
                })
                ->pluck('device_token')->all();


        $data = [
            "registration_ids" =>$firebaseToken,
            "notification" => [
                "title" => "SiDono",
                "body" =>"Recuerda que tienes una una cita agendada para donar sangre, revisa la aplicación",
                "content_available" => true,
                "priority" => "high",
            ]
        ];

        $this->notificacion($data);
    }



    public function notificacion($data)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $SERVER_API_KEY = 'AAAAWOH_v3w:APA91bHDcZDcnfHIQTIY8EeKFz90t43hz44zS-MhJTws8Ry6ZurU_jWlH3oQuw0mr9skUpzrdEqALI2tiHAjvlI_3KglJP9LxvCGG3hNeyI61vWuiHlCfc-Sg9D1eWb-yxTsac8he2Uh';

        $encodedData = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);



        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
    }


    public function show($id)
    {

    }

}
