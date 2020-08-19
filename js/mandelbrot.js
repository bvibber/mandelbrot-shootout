class Complex {
    constructor(x, y) {
        this.x = x;
        this.y = y;
    }

    abs() {
        return Math.sqrt(this.x * this.x + this.y * this.y);
    }

    add(other) {
        this.x += other.x;
        this.y += other.y;
    }

    mul(other) {
        let newX = this.x * other.x - this.y * other.y;
        let newY = this.x * other.y + this.y * other.x;
        this.x = newX;
        this.y = newY;
    }
}

// z(n+1) = z(n)^2 + c
function iterate_mandelbrot(c, maxIters) {
    let z = new Complex(0, 0);
    for (let i = 0; i < maxIters; i++) {
        if (z.abs() >= 2) {
            return i;
        }
        z.mul(z);
        z.add(c);
    }
    return maxIters;
}

let start = Date.now();
let x0 = -2.5, x1 = 1, y0 = -1, y1 = 1;
let cols = 72, rows = 24;
let maxIters = 1000000;

for (let row = 0; row < rows; row++) {
    let y = (row / rows) * (y1 - y0) + y0;
    let str = '';
    for (let col = 0; col < cols; col++) {
        let x = (col / cols) * (x1 - x0) + x0;
        let c = new Complex(x, y);
        let iters = iterate_mandelbrot(c, maxIters);
        if (iters == 0) {
            str += '.';
        } else if (iters == 1) {
            str += '%';
        } else if (iters == 2) {
            str += '@';
        } else if (iters == maxIters) {
            str += ' ';
        } else {
            str += '#';
        }
    }
    console.log(str);
}

let end = Date.now() - start;
console.log(end, 'milliseconds runtime');
