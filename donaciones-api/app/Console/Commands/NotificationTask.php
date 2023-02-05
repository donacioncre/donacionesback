<?php

namespace App\Console\Commands;

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
    public function __construct()
    {
        parent::__construct();
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
       
    }
}
