<?php
namespace App\View\Components;

use Illuminate\View\Component;

class IpkChart extends Component
{
    public $user;
    public $ipData;
    public $ipAvgData;

    public function __construct($user, $ipData, $ipAvgData)
    {
        $this->user = $user;
        $this->ipData = $ipData;
        $this->ipAvgData = $ipAvgData;
    }

    public function render()
    {
        return view('components.chart');
    }
}