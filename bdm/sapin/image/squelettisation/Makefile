CC = gcc
CFLAGS = -g -Wall

main : squelette.o module_p.o module_s.o
	gcc -o main squelette.o module_p.o module_s.o -lm
	
squelette.o : squelette.c module_p.h module_s.h

module_s.o : module_s.c

module_p.o : module_p.c

geany :
	geany *.c *h Makefile &
	
clean :
	rm *.o main
