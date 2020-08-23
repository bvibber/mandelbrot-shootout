<?php
declare(strict_types = 1);

const MAX_ITERS = 1000; //1000000;

// z(n+1) = z(n)^2 + c
function iterate_mandelbrot($cx, $cy) {
    $zx = 0.0;
    $zy = 0.0;
    $i = MAX_ITERS + 1;
    while (--$i) {
        $zxSqr = $zx * $zx;
        $zySqr = $zy * $zy;
        if ($zxSqr + $zySqr >= 4) {
            break;
        }
        $zy = 2 * $zx * $zy + $cy;
        $zx = $zxSqr - $zySqr + $cx;
    }
    return MAX_ITERS - $i;
}

$start = microtime(true) * 1000;
$x0 = -2.5;
$x1 = 1;
$y0 = -1;
$y1 = 1;
$cols = 72;
$rows = 24;

for ($row = 0; $row < $rows; $row++) {
    $y = ($row / $rows) * ($y1 - $y0) + $y0;
    $str = '';
    for ($col = 0; $col < $cols; $col++) {
        $x = ($col / $cols) * ($x1 - $x0) + $x0;
        $iters = iterate_mandelbrot($x, $y);
        if ($iters == 0) {
            $str .= '.';
        } elseif ($iters == 1) {
            $str .= '%';
        } elseif ($iters == 2) {
            $str .= '@';
        } elseif ($iters == MAX_ITERS) {
            $str .= ' ';
        } else {
            $str .= '#';
        }
    }
    print "$str\n";
}

$end = microtime(true) * 1000 - $start;
print "$end milliseconds runtime\n";
