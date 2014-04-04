
import cv2
import numpy as np

from matplotlib import pyplot as plt
#apt-get install pyhthon-matplotlib

img_source = cv2.imread('Lenna.png',0)
imgcopy = img_source.copy()
img_template = cv2.imread('Lenna_crop.png',0)

w,h = img_template.shape[::-1]

# All methods for comparison in list
methods = ['cv2.TM_CCOEFF','cv2.TM_CCOEFF_NORMED','cv2.TM_CCORR','cv2.TM_CCORR_NORMED','cv2.TM_SQDIFF','cv2.TM_SQDIFF_NORMED']

for meth in methods:
	img_source = imgcopy.copy()
	method = eval(meth)
	
	#Apply template Matching
	res = cv2.matchTemplate(img_source,img_template,method)
		
	
	min_val,max_val,min_loc,max_loc = cv2.minMaxLoc(res)
	
	if method in [cv2.TM_SQDIFF,cv2.TM_SQDIFF_NORMED]:
	
		top_left = min_loc
		
	else:
		
		top_left = max_loc
	
	bottom_right = (top_left[0]+w,top_left[1]+h)
	cv2.rectangle(img_source,top_left,bottom_right,255,2)
	
	plt.subplot(121),plt.imshow(res,cmap = 'gray')
	plt.title('Matching Result'),plt.xticks([]),plt.yticks([])
	
	plt.subplot(122),plt.imshow(img_source,cmap = 'gray')
	plt.title('Detected point'),plt.xticks([]),plt.yticks([])
	
	plt.suptitle(meth)
	
	plt.show()
		
			
