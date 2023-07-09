from django.contrib import admin
from django.urls import path, include
from MyApp.views import ProcessItAPI, ResultListAPI,ResultOneListAPI,DestroyOneOnListAPI,ImageViewSet
from rest_framework import routers

router = routers.DefaultRouter()
router.register('images', ImageViewSet, basename='image')

urlpatterns = [
#    Le declencheur
    # path('ProcessItAPI/', ProcessItAPI.as_view(), name="ProcessIt-Post"),
    path('ResultListAPI/', ResultListAPI.as_view(), name="ResultList-Get"),
    path('ResultOneListAPI/<int:pk>/', ResultOneListAPI.as_view(), name="ResultOneList-Get"),
    path('ResultOneListAPI/<int:pk>/', ResultOneListAPI.as_view(), name="ResultOneList-Get"),
    path('DeleteOneOnListAPI/<int:pk>/', DestroyOneOnListAPI.as_view(), name="DeleteOneOnList-Delete"),
    path('', include(router.urls))
 ]