"""from django.urls import path
from .views import ProductViewset
from rest_framework import routers

router = routers.SimpleRouter()

router.register('products', ProductViewset, basename = 'Products')
urlpatterns = [
  path("products/",ProductList.as_view()),
  path("products/<int:pk>/",ProductDetail.as_view()),
  ]
  """
