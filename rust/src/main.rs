use std::time::Instant;

#[derive(Clone, Copy)]
struct Complex {
    x: f64,
    y: f64,
}

impl Complex {
    fn new(x: f64, y: f64) -> Self {
        Complex { x, y }
    }

    fn abs(&self) -> f64 {
        (self.x * self.x + self.y * self.y).sqrt()
    }

    fn add(&mut self, other: Complex) {
        self.x += other.x;
        self.y += other.y;
    }

    fn mul(&mut self, other: Complex) {
        let new_x = self.x * other.x - self.y * other.y;
        let new_y = self.x * other.y + self.y * other.x;
        self.x = new_x;
        self.y = new_y;
    }
}

fn iterate_mandelbrot(c: Complex, max_iters: u32) -> u32 {
    let mut z = Complex::new(0_f64, 0_f64);
    for i in 0..max_iters {
        if z.abs() >= 2_f64 {
            return i;
        }
        z.mul(z);
        z.add(c);
    }

    max_iters
}

fn main() {
    let start = Instant::now();
    let x0 = -2.5;
    let x1 = 1_f64;
    let y0 = -1_f64;
    let y1 = 1_f64;
    let cols = 72;
    let rows = 24;
    let max_iters: u32 = 1000000;

    for row in 0..rows {
        let y = (row as f64 / rows as f64) * (y1 - y0) + y0;
        let mut str = vec![];
        for col in 0..cols {
            let x = (col as f64 / cols as f64) * (x1 - x0) + x0;
            let c = Complex::new(x, y);
            let iters = iterate_mandelbrot(c, max_iters);
            str.push(match iters {
                0 => ".",
                1 => "%",
                2 => "@",
                // max_iters
                1000000 => " ",
                _ => "#",
            });
        }
        println!("{}", str.join(""));
    }
    println!("{} milliseconds runtime", start.elapsed().as_millis());
}
