# Generated by Django 4.2.3 on 2023-07-08 17:10

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('MyApp', '0001_initial'),
    ]

    operations = [
        migrations.CreateModel(
            name='ResultList',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('nom_maladie', models.CharField(max_length=100)),
                ('pourcentage', models.CharField(max_length=100)),
            ],
        ),
    ]
