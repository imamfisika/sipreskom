<?php

namespace App\Helpers;

use App\Models\Akademik;
use App\Models\User;

class IpkPredictorHelper
{
    public static function predictNextIP(array $ips)
    {
        $n = count($ips);
        if ($n < 2) return end($ips);

        $x = range(1, $n);
        $y = $ips;

        $meanX = array_sum($x) / $n;
        $meanY = array_sum($y) / $n;

        $num = $den = 0;
        for ($i = 0; $i < $n; $i++) {
            $num += ($x[$i] - $meanX) * ($y[$i] - $meanY);
            $den += pow($x[$i] - $meanX, 2);
        }

        $m = $den != 0 ? $num / $den : 0;
        $b = $meanY - ($m * $meanX);

        $nextX = $n + 1;
        $nextIP = $m * $nextX + $b;

        return round($nextIP, 2);
    }
}