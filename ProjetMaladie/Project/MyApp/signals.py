# myapp/signals.py
from django.db.models.signals import post_save
from django.dispatch import receiver
from MyApp.models import Image
import subprocess


@receiver(post_save, sender=Image)
def run_treatment(sender, instance, **kwargs):
    if kwargs.get('created', False):
        subprocess.call(['python','C:\\Users\\Chikita\\Desktop\\ProjetMaladie\\Projet\\objectDetect\\autoPredict.py'])

