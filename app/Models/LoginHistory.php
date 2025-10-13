<?php

namespace App\Models;

use App\Events\UpdateUserLogout;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function updateLogoutTimestamp(UpdateUserLogout $event)
    {
        $lastLogin = $event->user->loginHistory->where('ip', $event->request->ip)->last();

        if (!$lastLogin) {
            self::create([
                'user_id' => $event->user->id,
                'ip_address' => $event->request->ip(),
                'logged_in_at' => now(),
            ]);

            return;
        }

        $diffInSeconds = $lastLogin->updated_at->diffInSeconds(now());

        if ($diffInSeconds < 60) {
            $lastLogin->touch();
            return;
        }

        self::create([
            'user_id' => $event->user->id,
            'ip_address'   => $event->request->ip(),
        ]);
    }
}
