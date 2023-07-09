from rest_framework import serializers
from .models import vidange, Enterprise, Worker
from rest_framework.validators import UniqueValidator
from django.contrib.auth.password_validation import validate_password

class EnterpriseSerializer(serializers.ModelSerializer):

    class Meta:
        model = Enterprise
        fields = '__all__'
        
class workerSerializer(serializers.ModelSerializer):

    class Meta:
        model = Worker
        fields = '__all__'
        
class vidangeSerializer(serializers.ModelSerializer):

    class Meta:
        model = vidange
        fields = '__all__'
        
"""class RegisterSerializer(serializers.ModelSerializer):
    username = serializers.CharField(
            required=True
            )
    last_name = serializers.CharField(
            required=True,
            validators=[UniqueValidator(queryset=User.objects.all())]
            )

    matricule = serializers.CharField(write_only=True, required=True, validators=[validate_password])

    class Meta:
        model = User
        fields = ('username', 'last_name', 'matricule')
       # extra_kwargs = {
       #    'first_name': {'required': True},
        #    'last_name': {'required': True}
        #}
        

   # def validate(self, attrs):
   #     if attrs['password'] != attrs['password2']:
   #         raise serializers.ValidationError({"password": "Password fields didn't match."})

       

    def create(self, validated_data):
        user = User.objects.create(
            password=validated_data['matricule'],
            first_name=validated_data['username'],
            last_name=validated_data['last_name']
        )

        
        #user.set_password(validated_data['matricule'])
        #user.save()

        return user"""
