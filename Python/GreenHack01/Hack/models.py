from django.db import models
from django.contrib.auth.models import AbstractUser
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.contrib.auth.models import User
from .managers import CustomUserManager
# Create your models here.

class Worker(models.Model):
	matricule = models.CharField(max_length = 255, unique=True)
	nom = models.CharField(max_length = 255)
	prenom = models.CharField(max_length = 255)
	def __str__(self):
		return self.nom
        	
class Enterprise(models.Model):
	name = models.CharField(max_length = 255)
	plastic_weights = models.IntegerField()
	def __str__(self):
        	return self.name
        	
class vidange(models.Model):
	localisation = models.CharField(max_length = 255)
	enterprise = models.OneToOneField('Enterprise', on_delete=models.CASCADE)
	worker_associated = models.OneToOneField(Worker, on_delete=models.CASCADE)
	status = models.CharField(max_length = 255)
	def __str__(self):
        	return self.enterprise.name+" : "+self.localisation
        	

        	

