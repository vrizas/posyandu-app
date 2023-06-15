<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function getAge($date) {
        return intval(date('Y', time() - strtotime($date))) - 1970;
    }

    public function index()
    {
        $user = auth()->user();
        $items = $user->posyandus;

        $currentHeight = $items[date('n') - 1]->height;
        $currentWeight = $items[date('n') - 1]->weight;
        $weightStatus = null;
        $weightStatusColor = null;
        
        if (is_int($currentHeight) && is_int($currentWeight)) {
            $imt = $currentWeight / (($currentHeight / 100) * ($currentHeight / 100));
            if ($imt < 18.5) {
                $weightStatus = 'Underweight';
                $weightStatusColor = 'orange';
            } else if ($imt < 23) {
                $weightStatus = 'Normal';
                $weightStatusColor = 'primary';
            } else if ($imt < 25) {
                $weightStatus = 'Overweight';
                $weightStatusColor = 'warning';
            } else if ($imt < 30) {
                $weightStatus = 'Obesitas';
                $weightStatusColor = 'danger';
            } else if ($imt >= 30) {
                $weightStatus = 'Obesitas II';
                $weightStatusColor = 'danger';
            } else {
                $weightStatus = null;
            }
        } else {
            $weightStatus = null;
        }

        return view('dashboard', ['items' => $items, 'weightStatus' => $weightStatus, 'weightStatusColor' => $weightStatusColor]);
    }
}
