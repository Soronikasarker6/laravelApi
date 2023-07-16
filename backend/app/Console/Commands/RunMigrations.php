<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RunMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */


    public function handle()
    {
        $task = new Task();
        
        $currentDate = Carbon::now();
        $taskName = $currentDate->format('d-m-N-i');
        $insertRowList = [];
       
        $insertRowList = [
            'time'                      => $currentDate->format('Y-m-d'),
            'task_name'                 => $taskName,
            'email'                     => $taskName. '@gmail.com',
            'created_at'                => $currentDate,
            'updated_at'                => $currentDate,
        ];
        Task::upsert($insertRowList, ['time', 'task_name', 'email'],['time']);
        
        return Command::SUCCESS;
    }
}
