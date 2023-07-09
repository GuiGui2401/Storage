from rest_framework.serializers import ModelSerializer
from .models import Category, Product, Question

class CategorySerializer(ModelSerializer):
  
  class Meta:
    model = Category
    Fiels = '__all__'
    
class ProductSerializer(ModelSerializer):

  class Meta:
    model = Product
    fields = '__all__'
    
class QuestionSerializer(ModelSerializer):

  class Meta:
    model = Question
    fields = ['content','title','exo_name']
    
class AdminQuestionSerializer(ModelSerializer):

  class Meta:
    model = Question
    fields = ['title','exo_name','answer','struct', 'content']
