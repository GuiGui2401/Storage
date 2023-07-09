package com.example.testpfe;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;

public class forgot extends AppCompatActivity {

    ImageView back;
    Button login;
    EditText code;
    EditText email;
    EditText password1;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_forgot);

        back= findViewById(R.id.imageView39);
        back.setOnClickListener(new View.OnClickListener() {
                                     @Override
                                     public void onClick(View v) {
                                         Intent i = new Intent(forgot.this, Login.class);
                                         startActivity(i);
                                         finish();
                                     }
                                 }
        );

        code = findViewById(R.id.editTextText3);
        email = findViewById(R.id.editTextText4);
        password1 = findViewById(R.id.editTextTextPassword6);
        login = findViewById(R.id.button13);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String cod = code.getText().toString();
                String em = email.getText().toString();
                String pwd1 = password1.getText().toString();
                if (cod.equals(String.valueOf("")))
                    code.setError("Enter unique id");
                else if (em.equals(String.valueOf("")))
                    email.setError("Enter email value");
                else if (pwd1.equals(String.valueOf("")))
                    password1.setError("Enter password");
                else {
                    Intent i = new Intent(forgot.this, accueil.class);
                    startActivity(i);
                    finish();
                }
            }
        });
    }
}