<?php

namespace App\Console\Commands;

use App\Models\Admin\Organizations;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OrganizationSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'organization:schedule-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Organization will be goes to expired after 365 days';

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
        $now = Carbon::now()->format('Y-m-d H:i:s.u');
        Organizations::where('expire_at', '<', $now )->update(['status'=>'expired']);
        $this->info('Organization added to expired list...');
    }
}
