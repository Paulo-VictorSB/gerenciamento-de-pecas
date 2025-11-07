<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

abstract class Controller
{
    public $data = [];

    public function __construct()
    {
        $datetime = Carbon::now();
        $datetime = $datetime->format('d/m/Y H:i:s');

        $this->data = [
            'success' => true,
            'data' => [],
            'message' => null,
            'date' => $datetime,
            'api_version' => "1.0"
        ];
    }

    protected function respond(int $status = 200)
    {
        return response()->json($this->data, $status);
    }
}
