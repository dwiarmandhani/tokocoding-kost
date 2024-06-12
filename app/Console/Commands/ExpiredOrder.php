<?php

namespace App\Console\Commands;

use App\Room;
use App\Transaction;
use Illuminate\Console\Command;
use phpDocumentor\Reflection\Types\Null_;

class ExpiredOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check expired order';

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
        $expired = Transaction::whereNull('bukti_pembayaran')->Where('expired_at',"<",now())->update([
            'status' => "Dibatalkan"
        ])->everyMinute();
    }
}
