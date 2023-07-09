from django.db import models
from django.db.models.signals import post_save
from django.dispatch import receiver
import subprocess

# Create your models here.

class ProcessIt(models.Model):
    nom = models.CharField(max_length=5)

class ResultList(models.Model):
    nom_maladie = models.CharField(max_length=100)
    pourcentage = models.CharField(max_length=100)  

class Image(models.Model):
    file = models.ImageField(upload_to='objectDetect/testImage/')