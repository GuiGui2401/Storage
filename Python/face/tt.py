import cv2
import os 
from PIL import Image, ImageDraw
import numpy as np
from matplotlib import pyplot as plt
from matplotlib.image import imread
imagePath = 'c:\Users\ADAMA\Desktop\face\hourey'
cascPath = 'C:\Users\ADAMA\AppData\Local\Programs\Python\Python37\Lib\site-packages\cv2\data\haarcascade_frontalface_default.xml'
detector = cv2.CascadeClassifier(cascPath)
cv2.__version__
imagePath = 'C:\\Users\\ADAMA\\data analytics\\computer vision\\beckhamtrumpkim\\'
imagefulllist = ['0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '1.0', '1.1', '1.2', '1.3', '1.4', '1.5'
                , '2.0', '2.1', '2.2']

plt.figure(figsize=(20, 20))
for count, item in enumerate(imagefulllist): 
    id = item.split(".")[0]
    #print(id)
    plt.subplot(6,6,count+1)
    filename = imagePath + item + '.jpg'
    image = imread(filename)
    #print(filename)
    plt.imshow(image)

