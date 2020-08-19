final class Complex {
    public double x;
    public double y;

    public Complex(double x, double y) {
        this.x = x;
        this.y = y;
    }

    public final double abs() {
        return Math.sqrt(this.x * this.x + this.y * this.y);
    }

    public final void add(Complex other) {
        this.x += other.x;
        this.y += other.y;
    }

    public final void mul(Complex other) {
        double newX = this.x * other.x - this.y * other.y;
        double newY = this.x * other.y + this.y * other.x;
        this.x = newX;
        this.y = newY;
    }
}
