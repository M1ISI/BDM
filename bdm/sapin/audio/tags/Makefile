CC = gcc
CFLAGS = -g -Wall

main : mp3tag_v2.o 
	gcc -o main mp3tag_v2.o -lm
	
mp3tag_v2.o : mp3tag_v2.c

geany :
	geany *.c *.cpp *h Makefile &
	
clean :
	rm *.o main
