# IMPORT
import os
from PIL import Image
import numpy as np
from tqdm import tqdm
import os

"""
# Classe permettant de convertir notre dataset d'images en tableaux Numpy
"""


def launchConversion(pathData, pathNumpy, resizeImg, imgSize):
    """
    # Permet de lancer la conversion des images en tableau numpy
    :param pathData: chemin ou sont les
    :param pathNumpy:
    :param resizeImg:
    :param imgSize:
    """

    #Variable pour stocker les labels (id) des nos classe
    labels = []

    #Pour chaque classe
    for imageClasse in os.listdir(pathData):
        pathImage = pathData + '\\' + imageClasse
        imgs = []
        
        #Ajouter le nom (id) de la classe courante à la liste
        labels.append(imageClasse)

        #Pour chaque image d'une classe, on la charge, resize et transforme en tableau
        for imgObject in tqdm(os.listdir(pathImage), "Conversion de la classe : '{}'".format(imageClasse)):
            imgObjectPath = pathImage + '\\' + imgObject
            img = Image.open(imgObjectPath)
            img.load()
            if resizeImg == True:
                img = img.resize(size=imgSize)

            data = np.asarray(img, dtype=np.float32)
            imgs.append(data)

        #Converti les gradients de pixels (allant de 0 à 255) vers des gradients compris entre 0 et 1
        imgs = np.asarray(imgs) / 255.

        #Enregistre une classe entiere en un fichier numpy
        np.save(pathNumpy + '\\ ' + imageClasse + '.npy', imgs)

    #Definir le chemin du fichier des labels, ecrire la liste des labels (id) dans le fichier et fermer le fichier
    current_dir = os.path.dirname(__file__) 
    pathClassesLabel = os.path.join(current_dir, 'label\\classes_label.py')
    fichier = open(pathClassesLabel, "w")
    fichier.write("labels = "+str(labels))
    fichier.close()

def main():
    """
    # Fonction main
    """

    current_dir = os.path.dirname(__file__)  # get current directory
    pathNumpy = os.path.join(current_dir, 'numpy')
    pathData = os.path.join(current_dir, 'dataset')
    resizeImg = True
    imgSize = (50, 50)
    launchConversion(pathData, pathNumpy, resizeImg, imgSize)


if __name__ == '__main__':
    """
    # MAIN
    """
    main()