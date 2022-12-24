<?php

namespace App\Traits;

use App\Notifications\UserActivities;
use App\User;

trait InformAdmin
{
    final public function userActivity($subject, $heading, $list, $link): void
    {
        (new User())
            ->fill(['email' => config('mail.from.address')])
            ->notify(new UserActivities($subject, $heading, $list, $link));
    }
}