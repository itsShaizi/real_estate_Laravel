<?php

namespace App\Console\Commands;

use App\Events\AuctionEndedTriggered;
use App\Models\Auction;
use Illuminate\Console\Command;

class ProcessCompletedAuctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auctions:process-completed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finds auctions that ended in the last ten minutes and triggers the Event';

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
        foreach($this->getLastAuctionsCompleted() as $auction)
        {
            $this->info('Auction: ID - '.$auction->id.' ended '. $auction->end_date . ' at ' . $auction->end_time);
            AuctionEndedTriggered::dispatch($auction);
        }
    }

    /**
     * Return the auctions ended since the last 10 minutes.
     *
     */
    private function getLastAuctionsCompleted()
    {

        $from = now()->setTimezone('US/Eastern')->subMinutes(9);
        $to = now()->setTimezone('US/Eastern');

        $auctions = Auction::where('end_date', '>=', $from->format('Y-m-d'))
        ->where('end_time', '>=', $from->format('H:i'))
        ->where('end_date', '<=', $to->format('Y-m-d'))
        ->where('end_time', '<=', $to->format('H:i'))->get();

        return $auctions;
    }

}
