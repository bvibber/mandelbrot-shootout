import math
import time

class Complex:
    def __init__(self, x, y):
        self.x = x
        self.y = y

    def abs(self):
        return math.sqrt(self.x * self.x + self.y * self.y)

    def add(self, other):
        self.x += other.x
        self.y += other.y

    def mul(self, other):
        newX = self.x * other.x - self.y * other.y
        newY = self.x * other.y + self.y * other.x
        self.x = newX
        self.y = newY


# z(n+1) = z(n)^2 + c
def iterate_mandelbrot(c, maxIters):
    z = Complex(0, 0)
    for i in range(0, maxIters):
        if z.abs() >= 2:
            return i
        z.mul(z)
        z.add(c)
    return maxIters


start = time.monotonic()
x0 = -2.5; x1 = 1; y0 = -1; y1 = 1
cols = 72; rows = 24
maxIters = 1000000

for row in range(0, rows):
    y = (float(row) / float(rows)) * (y1 - y0) + y0
    str = ''
    for col in range(0, cols):
        x = (float(col) / float(cols)) * (x1 - x0) + x0
        c = Complex(x, y)
        iters = iterate_mandelbrot(c, maxIters)
        if iters == 0:
            str += '.'
        elif iters == 1:
            str += '%'
        elif iters == 2:
            str += '@'
        elif iters == maxIters:
            str += ' '
        else:
            str += '#'
    print(str)

end = time.monotonic() - start
print(end * 1000.0, 'milliseconds runtime')
