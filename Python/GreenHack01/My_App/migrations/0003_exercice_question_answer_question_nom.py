# Generated by Django 4.2.1 on 2023-05-23 11:19

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ("My_App", "0002_question"),
    ]

    operations = [
        migrations.CreateModel(
            name="Exercice",
            fields=[
                (
                    "id",
                    models.BigAutoField(
                        auto_created=True,
                        primary_key=True,
                        serialize=False,
                        verbose_name="ID",
                    ),
                ),
                ("exo", models.TextField(blank=True)),
                ("folder", models.CharField(max_length=255)),
            ],
        ),
        migrations.AddField(
            model_name="question",
            name="answer",
            field=models.CharField(default="", max_length=255),
            preserve_default=False,
        ),
        migrations.AddField(
            model_name="question",
            name="nom",
            field=models.CharField(default="", max_length=255),
            preserve_default=False,
        ),
    ]
