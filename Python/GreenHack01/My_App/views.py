from django.shortcuts import render
from rest_framework.decorators import action
from rest_framework.views import APIView
from django.http import HttpResponse
from rest_framework.viewsets import ReadOnlyModelViewSet, ModelViewSet
from rest_framework.response import Response
from rest_framework.permissions import IsAuthenticated
from rest_framework import status


from .models import Product, Category
from .serializers import CategorySerializer, ProductSerializer, QuestionSerializer, AdminQuestionSerializer
# for unity
import shutil, os
import requests

URL = 'https://api.codex.jaagrav.in/'

# Create your views here.
"""class ProductList(APIView):
  def get(self, request):
    products = Product.objects.all()
    data = ProductSerializer(products, many = True)
    return Response(data.data)
    
class ProductDetail(APIView):
  def get(self, request, pk):
    product = get_object_or_404(Product, pk = pk)
    data = ProductSerializer(product)
    return Response(data.data)
    """
class ProductViewset(ReadOnlyModelViewSet):
    serializer_class = ProductSerializer
    def get_queryset(self):
      return Product.objects.all()
      
class SendToServer(ReadOnlyModelViewSet):
  serializer_class = QuestionSerializer
  @action(methods=['post'], detail=False)
  def require(self,request):
	  ###############################
	  ## copy the file to avoid directly modify it
	  #########################################
          folder = request.POST["title"]
          nom = request.POST["exo_name"]
          original = r'/home/kyul/test_api/'+folder+'/'+nom+'/struct.txt'
          target = r'/home/kyul/test_api/'+folder+'/'+nom+'/F1.txt'
          Rep = r'/home/kyul/test_api/'+folder+'/'+nom+'/rep.txt'
          shutil.copyfile(original, target)
          ########################################
          code = request.POST["content"]
          with open(target, 'r+') as f:
            contents = f.read().replace('hey', code)
            f.seek(0)
            f.truncate()
            f.write(contents)
          f.close()
          
          a = True
          file_line = ""
          with open(target,"r") as file_text:
            while a:
              fl = file_text.readline()
              if not fl:
                a = False
              else:
                file_line += fl

          file_text.close()
          ####Close and delete and the file after it
          os.remove(target)
          ##The answer to the question
          rep = ""
          with open(Rep,"r") as f:
            rep = f.readline()
          f.close()
          
          print(code)
          PARAMS = {'code': file_line, 'language': 'c', 'input': ''}
          r = requests.post(url = URL , data=PARAMS)
          data = r.json()
          print(data['output'],":", rep)
          if(data['output'].strip() == rep.strip()):
            return HttpResponse("it matches")
            
          else :
            return HttpResponse("it doesn't : ",data['output'])
          pass

class AdminSendToServer(ReadOnlyModelViewSet):
	serializer_class = AdminQuestionSerializer
	@action(methods=['post'], detail=False)
	def evaluate(self, request):
	##create dir for new lesson or exercise
          directory_title = request.POST["title"]
          exo_title = request.POST["exo_name"]
          parent_dir = r'/home/kyul/test_api/'+directory_title+'/'
          path = os.path.join(parent_dir, exo_title)
          os.makedirs(path, exist_ok=True) 
          
          with open(r'/home/kyul/test_api/'+directory_title+'/'+exo_title+'/struct.txt', 'a') as f:
            f.write(request.POST["struct"])
          f.close()
          with open(r'/home/kyul/test_api/'+directory_title+'/'+exo_title+'/question.txt', 'a') as f:
            f.write(request.POST["content"])
          f.close()
          with open(r'/home/kyul/test_api/'+directory_title+'/'+exo_title+'/rep.txt', 'a') as f:
            f.write(request.POST["answer"])
          f.close()
          return HttpResponse("written okay")
      
class AdminProductViewset(ModelViewSet):
    serializer_class = ProductSerializer
    permission_classes = [IsAuthenticated] 
    def get_queryset(self):
      return Product.objects.all()
