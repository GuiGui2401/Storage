"""
URL configuration for My_Api project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/4.2/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.urls import path, include
from django.contrib import admin
#from My_App.views import ProductViewset, AdminProductViewset, SendToServer, AdminSendToServer
#from blog.views import UserViewSet, LogoutView, AuthorViewSet, StoryViewSet, CategoryViewSet, ChapterViewSet
from Hack.views import login, refresh, take_task
from Hack.views import vidangeViewSet,WorkViewSet, EnterpriseViewSet
from rest_framework import routers
""" from rest_framework_simplejwt.views import ( TokenObtainPairView,
    TokenRefreshView,
    ) """

router = routers.SimpleRouter()
router.register('vidange', vidangeViewSet, basename = 'vidange')
router.register('register', WorkViewSet, basename = 'register')
router.register('Enterprise', EnterpriseViewSet, basename = 'register')

urlpatterns = [
    path("Hack/",include(router.urls)),
    ##
    path("Hack/refresh/", refresh, name = "refresh token"),
 #   path("Hack/token", TokenObtainPairView.as_view(), name = "token_obtain_pair"),
 #   path("Hack/token/refresh", TokenRefreshView.as_view(), name = "token_refresh"),
    path("Hack/login/", login, name = "log a user"),
    path("Hack/take_task/", take_task, name = "take_A_task"),
    path("accounts/", include('django.contrib.auth.urls')),
    ]
    
#router.register('products', ProductViewset, basename = 'Products')
"""
router.register('questions', SendToServer, basename = 'Questions')
router.register('admin-questions', AdminSendToServer, basename = 'Questions')
#router.register('admin-products', AdminProductViewset, basename = 'admin-Products')
#router.register(r'users', UserViewSet)

router.register('author', AuthorViewSet, basename = 'Authors')
router.register('story', StoryViewSet, basename = 'Story')
router.register('category', CategoryViewSet, basename = 'Category')
router.register('chapter', ChapterViewSet, basename = 'Chapters')

urlpatterns = [
    path("My_App/",include(router.urls)),
    path("My_App/login/", login, name = "log a user"),
    path("My_App/view_chap/", view, name = "view a chapter"),
    path("My_App/like_chap/", like, name = "like a chapters"),
    path("My_App/refresh/", refresh, name = "refresh token"),
    path("My_App/logout", LogoutView.as_view()),
    path("My_App/token", TokenObtainPairView.as_view(), name = "token_obtain_pair"),
    path("My_App/token/refresh", TokenRefreshView.as_view(), name = "token_refresh"),
    path("admin/", admin.site.urls),
    path("accounts/", include('django.contrib.auth.urls')),
    ]"""
    
    

