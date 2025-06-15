<?php

namespace App\Helpers;

class IPKPredictor
{
    protected $data = [];
    protected $targets = [];

    public function train(array $features, array $targets)
    {
        $this->data = $features;
        $this->targets = $targets;
    }

    public function predict(array $input)
    {
        $total = 0;
        $count = 0;

        foreach ($this->data as $i => $train) {
            $distance = 0;
            foreach ($input as $j => $val) {
                $distance += pow($val - ($train[$j] ?? 0), 2);
            }
            $distance = sqrt($distance);

            if ($distance < 1.5) {
                $total += $this->targets[$i];
                $count++;
            }
        }

        return $count > 0 ? round($total / $count, 2) : null;
    }
}