<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class Attempt extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'result',
    ];

    public static function uploadDataFromFile(): array
    {
        $content = Storage::get('data_attempts.json');
        $resultsData = json_decode($content, true);
        $results = [];

        foreach ($resultsData['data'] as $item) {
            $attempt = new Attempt();
            $attempt->id = $item['id'];
            $attempt->result = $item['result'];
            $results[] = $attempt;
        }

        return $results;
    }

    public static function unionData(array $users, array $results): array
    {
        $resultCollection = [];
        foreach ($users as $user) {
            $resultItem = [];
            $resultItem['user_id'] = $user->id;
            $resultItem['name'] = $user->name;
            $resultItem['city'] = $user->city;
            $resultItem['car'] = $user->car;
            $resultItem['result_sum'] = self::getSumResultByUser($user->id, $results);
            $resultItem['results'] = self::getAllResultsByUser($user->id, $results);
            $resultCollection[] = $resultItem;
        }

        return $resultCollection;
    }

    public static function getSumResultByUser(int $userId, array $allAttempts): int
    {
        $sum = 0;
        foreach ($allAttempts as $attempt) {
            if ($attempt->id == $userId) {
                $sum += $attempt->result;
            }
        }

        return $sum;
    }

    public static function getAllResultsByUser(int $userId, array $allAttempts): array
    {
        $arr = [];
        foreach ($allAttempts as $item) {
            if ($item->id == $userId) {
                $arr[] = $item->result;
            }
        }
        return $arr;
    }

    public static function sorting(array $results): array
    {
        usort($results, function($elemA, $elemB) {
            if ($elemA['result_sum'] > $elemB['result_sum']) {
                return -1;
            }
            if ($elemA['result_sum'] < $elemB['result_sum']) {
                return 1;
            }

            if ($elemA['results'][3] > $elemB['results'][3]) {
                return -1;
            } else if ($elemA['results'][3] < $elemB['results'][3]) {
                return 1;
            } else {
                return 0;
            }

            if ($elemA['results'][2] > $elemB['results'][2]) {
                return -1;
            } else if ($elemA['results'][2] < $elemB['results'][2]) {
                return 1;
            } else {
                return 0;
            }

            if ($elemA['results'][1] > $elemB['results'][1]) {
                return -1;
            } else if ($elemA['results'][1] < $elemB['results'][1]) {
                return 1;
            } else {
                return 0;
            }

            if ($elemA['results'][0] > $elemB['results'][0]) {
                return -1;
            } else if ($elemA['results'][0] < $elemB['results'][0]) {
                return 1;
            } else {
                return 0;
            }
        });
        
        for ($i = 0; $i < count($results); $i++) {
            $results[$i]['number'] = $i + 1;
        }
        
        return $results;
    }

    public static function generateData(): array|null
    {
        $users = User::uploadDataFromFile();
        $results = Attempt::uploadDataFromFile();
        $unionData = Attempt::unionData($users, $results);
        $sorting = Attempt::sorting($unionData);

        return $sorting;
    } 
}
