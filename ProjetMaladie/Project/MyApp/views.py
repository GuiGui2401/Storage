from django.shortcuts import render
from rest_framework import generics, viewsets, permissions
from .models import ProcessIt, ResultList
from .models import Image as MyImage
from .serializers import ProcessItSerializer, ResultListSerializer, ImageSerializer
import os

# Post For Signal
class ProcessItAPI(generics.CreateAPIView):
    queryset = ProcessIt.objects.all()
    serializer_class = ProcessItSerializer

# Read on table
class ResultListAPI(generics.ListAPIView):
    queryset = ResultList.objects.all()
    serializer_class = ResultListSerializer

# Read one value on table
class ResultOneListAPI(generics.RetrieveAPIView):
    queryset = ResultList.objects.all()
    serializer_class = ResultListSerializer

# Delete value on table
class DestroyOneOnListAPI(generics.DestroyAPIView):
    queryset = ResultList.objects.all()
    serializer_class = ResultListSerializer

class ImageViewSet(viewsets.ModelViewSet):
    queryset = MyImage.objects.all()
    serializer_class = ImageSerializer
    permission_classes = [permissions.AllowAny]