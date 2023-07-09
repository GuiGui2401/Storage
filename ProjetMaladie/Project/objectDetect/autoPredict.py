#IMPORT
import json
#import MyProject.objectDetect.label.classes_label as classes_label    # A utiliser l'orsqu'on lance le serveur
import label.classes_label as classes_label                          # A utiliser l'orsqu'on compile uniquement le fichier
from keras.models import load_model
from PIL import Image
import numpy as np
import time
import os
import mysql.connector


"""
# Classe permettant de réaliser une prédiction sur une nouvelle donnée
"""


# Chargement du modele 
module_dir = os.path.dirname(__file__)  # get current directory
modelPath = os.path.join(module_dir, 'trainedModel\\moModel.hdf5')
print("Chargement du modèle :\n")
model = load_model(modelPath)
print("\nModel chargé.")


def main():
    """
    # On definit les chemins d'acces au différentes hyper parametre
    """

    module_dir = os.path.dirname(__file__)  # get current directory
    modelPath = os.path.join(module_dir, 'trainedModel\\moModel.hdf5')
    detectIimagePath = os.path.join(module_dir, 'testImage\\testImage.jpg')
    imageSize = (50,50)

    predict(modelPath, detectIimagePath,imageSize)


"""
# Methode utilisé lors du tri de la liste de prediction
"""
def sort_by_percentage(list):
    return list['percentage']


def predict(modelPath,detectIimagePath, imageSize):
    """
    # Fonction qui permet de convertir une image en array, de charger le modele et de lui injecter notre image pour une prediction
    :param modelPath: chemin du modèle au format hdf5
    :param detectIimagePath: chemin de l'image pour realiser une prediction
    :param imageSize: défini la taille de l'image. IMPORTANT : doit être de la même taille que celle des images
    du dataset d'entrainements
    """

    #nom de nos classes de sortie
    labels = classes_label.labels

    start = time.time() 



    #Chargement de notre image et traitement
    data = []
    img = Image.open(detectIimagePath)
    img.load()
    img = img.resize(size=imageSize)
    img = np.asarray(img) / 255.
    data.append(img)
    data = np.asarray(data)


    dimension = data[0].shape

    #Reshape pour passer de 3 à 4 dimension pour notre réseau
    data = data.astype(np.float32).reshape(data.shape[0], dimension[0], dimension[1], dimension[2])

    #On realise une prediction
    prediction = model.predict(data)


    #On recupere le numero de labels qui a la plus haut prediction
    maxPredict = np.argmax(prediction)

    #On recupere le mot correspondant à l'indice precedent
    word = labels[maxPredict]
    pred = prediction[0][maxPredict] * 100.
    end = time.time()


    #On affiche les prédictions
    print()
    print('----------')
    print(" Prediction :")
    
    connection_params = {
    'host': "localhost",
    'user': "root",
    'password': "",
    'database': "maladie",
    }

    object_list = []
    for i in range(0, len(labels)):

        data = {
            "product_id": labels[i],
            "percentage": prediction[0][i] * 100.
        }
        object_list.append(data)
        print('     ' + labels[i] + ' : ' + "{0:.2f}%".format(prediction[0][i] * 100.))

        request = """INSERT INTO myapp_resultlist (nom_maladie, pourcentage) VALUES (%s, %s)"""
        params = [(str(labels[i]), str(prediction[0][i] * 100.)+"%")]

        with mysql.connector.connect(**connection_params) as db:
            with db.cursor() as c:
                c.executemany(request, params)
                db.commit()
                pass


    print()
    print('RESULTAT : ' + word + ' : ' + "{0:.2f}%".format(pred))
    print('temps prediction : ' + "{0:.2f}secs".format(end-start))

    print('----------')

   


    sorted_object_list = sorted(object_list, key=sort_by_percentage, reverse=True) # Trier la liste par ordre decroissant du pourcentage de prediction
    print(sorted_object_list[:50])

    return sorted_object_list[:50]




if __name__ == "__main__":
    """
    # MAIN
    """
    main()