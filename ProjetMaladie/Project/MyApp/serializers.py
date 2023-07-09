from .models import ProcessIt, ResultList,Image
from rest_framework import serializers

class ProcessItSerializer(serializers.ModelSerializer):
    class Meta:
        model = ProcessIt
        fields = '__all__'

class ResultListSerializer(serializers.ModelSerializer):
    class Meta:
        model = ResultList
        fields = '__all__'

class ImageSerializer(serializers.ModelSerializer):
    class Meta:
        model = Image
        fields = '__all__'