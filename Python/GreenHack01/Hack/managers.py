from django.contrib.auth.base_user import BaseUserManager
from django.utils.translation import gettext_lazy as _

class CustomUserManager(BaseUserManager):

	def create_user(self, username, pseudo, password, **etra_fields):
		if not email:
			raise ValueError(_("There must be an email!!"))
		#name = self.username
		user = self.model(username = username, pseudo = pseudo, **etra_fields)
		user.set_password(password)
		#user.save()
		return user
		
	def create_superuser(self, name, pseudo, password, **extra_fields):
		extra_fields.setdefault("is_staff", True)
		extra_fields.setdefault("is_superuser", True)
		extra_fields.setdefault("is_active", True)
		
		if extra_fields.get("is_staff") is not True :
			raise ValueError(_("Superuser must have staff=True"))
		
		if extra_fields.get("is_superuser") is not True:
			raise ValueError(_("Superuser must have is_superuser=True."))
		return self.create_user(email, pseudo, password, **extra_fields)
