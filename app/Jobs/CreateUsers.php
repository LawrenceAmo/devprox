<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels; 
use App\Models\csv_import;

class CreateUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

private $csvFile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
   public function __construct( $csvFile)
    {
        $this->csvFile = $csvFile;
    }

    // public $tries = 100;

    // public $maxExceptions = 10;


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() 
    {
        
        $createUsers = new csv_import(); 
        $all_users_info =$createUsers->get_users($this->csvFile);
        
         $createUsers->save_all_users( $all_users_info  );  // save all users to db

    }
}
