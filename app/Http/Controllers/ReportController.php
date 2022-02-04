<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class ReportController extends ReportFormatController
{
    public function __construct()
    {
        Carbon::setToStringFormat('d/m/y');
    }


    public function getCompletedOrders()
    {
        $this->fileName = 'Completed Orders';

        list($from, $to) = $this->getDateRange();

        return Order::where('status', Order::COMPLETE)->whereBetween('completed_at', [$from, $to])->get();
    }

    protected function getDateRange()
    {
        $from = Input::has('from') ? new Carbon(Input::get('from')) : null;
        $to = Input::has('to') ? new Carbon(Input::get('to')) : null;
        return [$from, $to];
    }

}
