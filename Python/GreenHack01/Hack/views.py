from django.shortcuts import render
from rest_framework.decorators import action
from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework.permissions import IsAuthenticated
from rest_framework.decorators import api_view
from rest_framework import status
from .models import vidange, Enterprise
from rest_framework.viewsets import ReadOnlyModelViewSet, ModelViewSet
from .serializers import EnterpriseSerializer, vidangeSerializer
from .serializers import workerSerializer
from .models import vidange, Worker,Enterprise
from rest_framework import generics
import requests

# Create your views here.

class vidangeViewSet(ModelViewSet):
    queryset = vidange.objects.all()
    serializer_class = vidangeSerializer
    permissiom_classes = [IsAuthenticated]
    
class WorkViewSet(ModelViewSet):
    queryset = Worker.objects.all()
    serializer_class = workerSerializer
    
class EnterpriseViewSet(ModelViewSet):
    queryset = Enterprise.objects.all()
    serializer_class = EnterpriseSerializer
    
"""class RegisterView(generics.CreateAPIView):
    queryset = User.objects.all()
    #permission_classes = (AllowAny,)
    serializer_class = RegisterSerializer"""
  
@api_view(['GET'])
def login(request):
		"""URL = 'http://localhost:8000/My_App/token'
		PARAMS = {'name': request.GET['usr'], 'password': request.GET['matricule']}
		r = requests.post(url = URL , data=PARAMS)
		data = r.json()
		return Response(data)"""
		user = Worker.objects.all().filter(matricule = request.GET['matricule']).first()
		if not user:
			return Response("No account")
		else:
			serializer = workerSerializer(user)
			if(serializer.is_valid):
				return Response(serializer.data)
		
@api_view(['GET'])
def refresh(request):
	URL = 'http://localhost:8000/My_App/token/refresh'
	tok_refresh =request.GET['refresh']
	PARAMS = {'refresh': tok_refresh}
	r = requests.post(url = URL , data=PARAMS)
	data = r.json()
	return Response(data)

## The technician select an undone task and mark it as "En cours"
@api_view(['GET'])
def take_task(request):
	instance = Worker.objects.filter(matricule = request.GET['matricule']).first()
	instance_trash = vidange.objects.filter(enterprise = request.GET['enterprise']).first()
	instance_data = vidangeSerializer(instance_trash)
	#worker_associated, enterprise
	status = instance_trash.data["status"]
	serializer = vidangeSerializer(instance_data, data = request.data, partial = True)
	if(request.GET['decision']=="Ok" and status != "undone" and serializer.is_valid()):
		serializer.validated_data["status"] = "En cours"
		serializer.save()
		return Response(serializer.data)
	else:
		return Response("hay")

	

