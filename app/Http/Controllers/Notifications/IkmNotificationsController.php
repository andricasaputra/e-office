<?php

namespace App\Http\Controllers\Notifications;

use App\Models\User;
use Illuminate\Http\Request;

class IkmNotificationsController extends MainNotificationController
{
    public function ikmApi(User $user)
    {
    	return $user->unreadNotifications()
    				->where('type', 'App\Notifications\NewSurveyIkm')
    				->get();
    }
}
