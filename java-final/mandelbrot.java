public class mandelbrot {

    static int iterate(Complex c, int maxIters) {
        Complex z = new Complex(0, 0);
        for (int i = 0; i < maxIters; i++) {
            if (z.abs() >= 2) {
                return i;
            }
            z.mul(z);
            z.add(c);
        }
        return maxIters;
    }
    
    public static void main(String[] args) {
        long start = System.currentTimeMillis();
        double x0 = -2.5, x1 = 1, y0 = -1, y1 = 1;
        int cols = 72, rows = 24;
        int maxIters = 1000000;

        for (int row = 0; row < rows; row++) {
            double y = ((double)row / (double)rows) * (y1 - y0) + y0;
            StringBuilder str = new StringBuilder();
            for (int col = 0; col < cols; col++) {
                double x = ((double)col / (double)cols) * (x1 - x0) + x0;
                Complex c = new Complex(x, y);
                int iters = mandelbrot.iterate(c, maxIters);
                if (iters == 0) {
                    str.append('.');
                } else if (iters == 1) {
                    str.append('%');
                } else if (iters == 2) {
                    str.append('@');
                } else if (iters == maxIters) {
                    str.append(' ');
                } else {
                    str.append('#');
                }
            }
            System.out.println(str.toString());
        }
        long end = System.currentTimeMillis() - start;
        System.out.printf("%d%n milliseconds runtime\n", end);
    }
}