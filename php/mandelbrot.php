<?php

class Complex {
    public $x;
    public $y;

    function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }

    function abs() {
        return sqrt($this->x * $this->x + $this->y * $this->y);
    }

    function add($other) {
        $this->x += $other->x;
        $this->y += $other->y;
    }

    function mul($other) {
        $newX = $this->x * $other->x - $this->y * $other->y;
        $newY = $this->x * $other->y + $this->y * $other->x;
        $this->x = $newX;
        $this->y = $newY;
    }
}

// z(n+1) = z(n)^2 + c
function iterate_mandelbrot(Complex $c, $maxIters) {
    $z = new Complex(0, 0);
    for ($i = 0; $i < $maxIters; $i++) {
        if ($z->abs() >= 2) {
            return $i;
        }
        $z->mul($z);
        $z->add($c);
    }
    return $maxIters;
}

$start = microtime(true) * 1000;
$x0 = -2.5;
$x1 = 1;
$y0 = -1;
$y1 = 1;
$cols = 72;
$rows = 24;
$maxIters = 1000000;

for ($row = 0; $row < $rows; $row++) {
    $y = ($row / $rows) * ($y1 - $y0) + $y0;
    $str = '';
    for ($col = 0; $col < $cols; $col++) {
        $x = ($col / $cols) * ($x1 - $x0) + $x0;
        $c = new Complex($x, $y);
        $iters = iterate_mandelbrot($c, $maxIters);
        if ($iters == 0) {
            $str .= '.';
        } else if ($iters == 1) {
            $str .= '%';
        } else if ($iters == 2) {
            $str .= '@';
        } else if ($iters == $maxIters) {
            $str .= ' ';
        } else {
            $str .= '#';
        }
    }
    print "$str\n";
}

$end = microtime(true) * 1000 - $start;
print "$end milliseconds runtime\n";
