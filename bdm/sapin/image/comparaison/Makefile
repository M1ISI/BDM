all: canny bmp2ptlist hausdorff

canny:
	gcc -lm -std=c99 -o bmp2canny bmp2canny.c

bmp2ptlist:
	gcc -o bmp2ptlist bmp2ptlist.c qdbmp.c

hausdorff:
	g++ -o hausdorff hausdorff_distance.cpp

clean:
	rm -rf bmp2canny bmp2ptlist hausdorff
