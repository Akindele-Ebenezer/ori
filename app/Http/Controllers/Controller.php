<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function notifyReport(string $vessel, string $action, string $subject, string $message): void
    {
        \DB::table('notifications')->insert([
            'DateIn' => now()->format('Y-m-d'),
            'TimeIn' => now()->format('H:i A'),
            'UserId' => session()->get('USER_ID'),
            'Vessel' => $vessel,
            'Action' => $action,
            'Subject' => $subject,
            'Notification' => $message,
        ]);
    }
}
