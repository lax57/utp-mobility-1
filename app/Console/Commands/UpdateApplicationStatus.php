<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Application;
use App\ApplicationStatus;
use DateTime;

class UpdateApplicationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command executs every day and updates the statuses of mobility\'s application '
            . 'which finished. New status of mobility is Feedback Required. '
            . 'From that moment applicants are obliged to upload an inform within 7 days';

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
     * @return mixed
     */
    public function handle()
    {
        //TODO: Send an email informing about status change, add notification 
        $historicalStatusId = ApplicationStatus::getStatusId(ApplicationStatus::HISTORICAL);
        $feedbackRequiredStatusId = ApplicationStatus::getStatusId(ApplicationStatus::FEEDBACK_REQUIRED);
        $rejectedStatusId = ApplicationStatus::getStatusId(ApplicationStatus::REJECTED);
        
        $applications = Application::where([
                    ['finish_date', '<', date("Y-m-d", strtotime("yesterday"))],
                    ['application_status_id', '!=', $historicalStatusId],
                    ['application_status_id', '!=', $feedbackRequiredStatusId],
                    ['application_status_id', '!=', $rejectedStatusId],
                ])->get();
        $newStatusId;
        foreach($applications as $application){
            $oldStatus = $application->applicationStatus;
            if($application->applicationStatus->name == ApplicationStatus::ACCEPTED) {
                $newStatusId = $feedbackRequiredStatusId;
            }else {
                $newStatusId = $rejectedStatusId;
            }
            //A user ID = 1 is passed to the method indicating that user is a system 
            $application->changeStatus($newStatusId, null);
        }
    }
}
