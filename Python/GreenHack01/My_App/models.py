from django.db import models

# Create your models here.
class Category(models.Model):

  date_created = models.DateTimeField(auto_now_add=True)
  date_updated = models.DateTimeField(auto_now_add=True)
  
  name = models.CharField(max_length=255)
  description = models.TextField(blank=True)
  
  def __str__(self):
      return self.name
      
      
class Product(models.Model):

  date_created = models.DateTimeField(auto_now_add=True)
  date_updated = models.DateTimeField(auto_now_add=True)
  
  name = models.CharField(max_length=255)
  description = models.TextField(blank=True)
  
  category = models.ForeignKey('Category',on_delete=models.CASCADE,related_name='products')
  
  def __str__(self):
      return self.name
      
      ## en fait question c est la reponse de l eleve
class Question(models.Model):

	content = models.TextField(blank=True)
	# The title of the lesson
	title = models.CharField(max_length=255)
	# The name of the exercise
	exo_name = models.CharField(max_length=255)
	# The answer of the exercice
	answer = models.CharField(max_length=255)
	#The structure
	struct = models.CharField(max_length=255)
	def __str__(self):
       	 return self.name
       	 
       	       
class Exercice(models.Model):

	exo = models.TextField(blank=True)
	folder = models.CharField(max_length=255)
	def __str__(self):
       	 return self.name
