CC = gcc
CFLAGS = -g -Wall

main : mp3tag_v2.o 
	gcc -o main mp3tag_v2.o -lm
	
mp3tag_v2.o : mp3tag_v2.c

mp3tag_addDb :
	$(CC) $(CFLAGS) mp3tag_addDb.c -o mp3tag -lsqlite3 -lm

geany :
	geany *.c Makefile &
	
clean :
	rm *.o main
