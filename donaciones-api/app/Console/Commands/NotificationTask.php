<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use App\Models\User;
use App\Repositories\NotificationRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class NotificationTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $notification;
    public function __construct(NotificationRepository $notification)
    {
        parent::__construct();

        $this->notification=$notification;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $texto ="[". date("Y-m-d H:i:s"). "]: Hola mm";
        Storage::append("archivo.txt",$texto);

        $this->notification->NotificationBirthday();
        $this->notification->NotificationSchedule();
       
    }
}
