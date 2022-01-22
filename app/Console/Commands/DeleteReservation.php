<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\BookUser;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeleteReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:reservation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Reservation if non take the book';

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
        $res = BookUser::where(['date_out' => null, 'date_in' => null])->get();
        if($res){
            foreach ($res as $re) {
                $star = Carbon::parse($re->due_date);
                $current = Carbon::now();
                $length = $star->diffInHours($current);
                if($length>=1){
                    $result = BookUser::destroy($re->id);
                    return $this->returnSuccessMessage('delete Reservation Success');
                }

            }

        }
        return $this->returnError('33','not found Reservation');

    }
}

