all: mandelbrot

clean:
	rm -f mandelbrot

run: mandelbrot
	./mandelbrot

mandelbrot : mandelbrot.c
	clang -o mandelbrot -O3 mandelbrot.c
