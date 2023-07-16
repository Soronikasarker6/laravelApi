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
        $insertRowList = [];

        $insertRowList = [
            'time'                      => Carbon::now()->format('Y-m-d'),
            'task_name'                 => Carbon::now()->format('d-m-N-i'),
            'email'                     => Carbon::now()->format('d-m-N-i').$task->task_name . '@gmail.com',
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now(),
        ];
        Task::upsert($insertRowList, ['time', 'task_name', 'email'],['time']);
        
        return Command::SUCCESS;
    }
}
