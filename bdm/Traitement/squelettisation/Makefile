CC = gcc
CFLAGS = -g -Wall

main : squelette.o module_p.o module_s.o
	gcc -o main squelette.o module_p.o module_s.o -lm
	g++ -c threshold.cpp -Wall `pkg-config opencv --cflags`
	g++ threshold.o -o threshold `pkg-config opencv --libs`
	
squelette.o : squelette.c module_p.h module_s.h

module_s.o : module_s.c

module_p.o : module_p.c

geany :
	geany *.c *.cpp *h Makefile &
	
clean :
	rm *.o main threshold
