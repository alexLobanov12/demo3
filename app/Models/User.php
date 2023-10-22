<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'city',
        'car',
    ];

    public static function uploadDataFromFile(): array
    {
        $content = Storage::get('data_cars.json');
        $usersContent = json_decode($content, true);
        $users = [];

        foreach ($usersContent['data'] as $item) {
            $user = new User();
            $user->id = $item['id'];
            $user->name = $item['name'];
            $user->city = $item['city'];
            $user->car = $item['car'];
            $users[] = $user;
        }

        return $users;
    }
}
