<?php

namespace App\Console\Commands;

use App\Http\Controllers\api\v1\ProfileController;
use Illuminate\Console\Command;

class SendFirebaseNotification extends Command
{
    protected $signature = 'notification:send';
    protected $description = 'Send Firebase Notifications to users based on due date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Call the controller method directly
        $controller = new ProfileController();
        $controller->sendFirebaseNotification(request());

        $this->info('Firebase notification sent successfully.');
    }
}
