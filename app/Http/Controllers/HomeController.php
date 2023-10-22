<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Attempt;
use Response;
use File;

class HomeController extends Controller
{
    public function index()
    {
        $data = Attempt::generateData();
        return view('index', ['results' => $data]);
    }

    public function printCSV()
    {
        $data = Attempt::generateData();
        $headers = [
            'Content-Type' => 'text/csv',
        ];

        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }
        $filename =  public_path("files/results.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "Номер места",
            "Имя пилота",
            "Город пилота",
            "Автомобиль",
            "Попытки",
            "Сумма очков",
        ]);

        foreach ($data as $item) {
            fputcsv($handle, [
                $item['number'],
                $item['name'],
                $item['city'],
                $item['car'],
                implode(',', $item['results']),
                $item['result_sum'],
            ]);

        }
        fclose($handle);
        return Response::download($filename, "results.csv", $headers);
    }
}
