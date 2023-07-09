# Generated by Django 4.2.1 on 2023-05-27 00:29

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ("My_App", "0003_exercice_question_answer_question_nom"),
    ]

    operations = [
        migrations.RenameField(
            model_name="question", old_name="folder", new_name="exo_name",
        ),
        migrations.RenameField(
            model_name="question", old_name="nom", new_name="struct",
        ),
        migrations.AddField(
            model_name="question",
            name="title",
            field=models.CharField(default="NONE", max_length=255),
            preserve_default=False,
        ),
    ]
