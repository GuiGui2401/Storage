# Generated by Django 4.2.1 on 2023-06-10 06:45

from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
        ("Hack", "0001_initial"),
    ]

    operations = [
        migrations.RemoveField(model_name="worker", name="user",),
        migrations.AlterField(
            model_name="vidange",
            name="worker_associated",
            field=models.OneToOneField(
                on_delete=django.db.models.deletion.CASCADE, to=settings.AUTH_USER_MODEL
            ),
        ),
        migrations.DeleteModel(name="User",),
        migrations.DeleteModel(name="Worker",),
    ]