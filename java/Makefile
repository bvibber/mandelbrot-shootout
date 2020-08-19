all: mandelbrot.class

clean:
	rm -f mandelbrot.class
	rm -f Complex.class

run: mandelbrot.class
	java mandelbrot

mandelbrot.class : Complex.class mandelbrot.java
	javac mandelbrot.java

Complex.class : Complex.java
	javac Complex.java

