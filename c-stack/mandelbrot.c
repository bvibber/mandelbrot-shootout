#include <math.h>
#include <memory.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>

typedef struct {
    double x;
    double y;
} Complex;

double complex_abs(const Complex* c) {
    return sqrt(c->x * c->x + c->y * c->y);
}

void complex_add(Complex* a, const Complex* b) {
    a->x += b->x;
    a->y += b->y;
}

void complex_mul(Complex* a, const Complex* b) {
    double newX = a->x * b->x - a->y * b->y;
    double newY = a->x * b->y + a->y * b->x;
    a->x = newX;
    a->y = newY;
}

// z(n+1) = z(n)^2 + c
int iterate_mandelbrot(const Complex* c, int maxIters) {
    Complex z = { 0, 0 };
    for (int i = 0; i < maxIters; i++) {
        if (complex_abs(&z) >= 2) {
            return i;
        }
        complex_mul(&z, &z);
        complex_add(&z, c);
    }
    return maxIters;
}

long long get_time_millis(void) {
    struct timespec tp;
    if (clock_gettime(CLOCK_MONOTONIC, &tp)) {
        abort();
    }
    return (long long)tp.tv_sec * 1000 + (long long)tp.tv_nsec / 1000000;
}

int main(int argc, const char** argv) {
    long long start = get_time_millis();
    double x0 = -2.5, x1 = 1, y0 = -1, y1 = 1;
    int cols = 72, rows = 24;
    int maxIters = 1000000;

    char* str = (char*)malloc(cols + 1);
    memset(str, 0, rows + 1);

    for (int row = 0; row < rows; row++) {
        double y = ((double)row / (double)rows) * (y1 - y0) + y0;
        for (int col = 0; col < cols; col++) {
            double x = ((double)col / (double)cols) * (x1 - x0) + x0;
            Complex c = { x, y };
            int iters = iterate_mandelbrot(&c, maxIters);
            if (iters == 0) {
                str[col] = '.';
            } else if (iters == 1) {
                str[col] = '%';
            } else if (iters == 2) {
                str[col] = '@';
            } else if (iters == maxIters) {
                str[col] = ' ';
            } else {
                str[col] = '#';
            }
        }
        printf("%s\n", str);
    }

    long long end = get_time_millis() - start;
    printf("%lld milliseconds runtime\n", end);
    free(str);
}
