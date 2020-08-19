# Mandelbrot Shootout

Just a quickie Mandelbrot Set fractal demo in several languages, to exercise some specific performance characteristics of their object implementations.

## What it does

Each version of the program calculates the Mandelbrot set escape iteration count at a low resolution, with one million maximum iterations per pixel. ASCII art is output showing the pretty fractal shape, and a count of execution time in milliseconds.

A bare-bones `Complex` object class is used to implement the math, representing the real and imaginary components as `x` and `y` properties, and providing accumulator-style methods to add and multiply, as well as the magnitude/abs-value function needed by the fractal.

Most of the runtime is in the iteration loop for the points inside the set.

## JavaScript

JavaScript does pretty well here running in `node`, optimizing the accesses to the `Complex` object type nicely.

On my machine this clocks in around 1250ms.

## Java

Java performs similarly to JavaScript here, but the JIT compiler probably has less work to do to get there!

Clocks in around 1250ms. I'd initially seen a wider range in performance based on use of the `final` keyword but can no longer reproduce it, it may have been background activity on the machine.

## PHP

Alas, this is a worst case for PHP 7.3; clocks in around 70 seconds, 56x slower than node.

PHP 8's JIT compiler, once enabled, can knock it down to about 40 seconds, a mere 32x slower than node. ;)
