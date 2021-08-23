<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Feeds\ListHub;
use Illuminate\Support\Facades\DB;

class import_listings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:listings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command imports all the listings from activated feed sources';

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


        $feeds = DB::table('feeds')->where('status', 'active')->get();

        foreach($feeds as $feed) {
            $this->info('Starting Sync for Feed: '.$feed->name.' at '.date('Y-m-d H:i:s'));
            $class_name = $feed->feed_class;
            $feed_ctrl = new $class_name();
            $feed_ctrl->import($feed->id);
            $this->info('Finished Sync for Feed: '.$feed->name.' at '.date('Y-m-d H:i:s'));
        }

        
    }
}
