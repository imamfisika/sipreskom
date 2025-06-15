<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Prediksi extends Component
{
    public $ipData, $predictedIp, $nextSemester;

    public function __construct($ipData = [], $predictedIp = null, $nextSemester = 1)
    {
        $this->ipData = $ipData;
        $this->predictedIp = $predictedIp;
        $this->nextSemester = $nextSemester;
    }

    public function render()
    {
        return view('rekomendasi');
    }
}