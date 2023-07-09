package com.example.testleon;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class Register extends AppCompatActivity {

    TextView login;

    Button submit;

    EditText edtUsr,edtPwd,edtNam,edtLNam;
    DatabaseHelper myDb;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        login = findViewById(R.id.textView4);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(Register.this, Login.class);
                startActivity(i);
                finish();
            }
        });

        myDb = new DatabaseHelper(this);
        submit = findViewById(R.id.button2);
        edtUsr = findViewById(R.id.editTextTextEmailAddress2);
        edtPwd = findViewById(R.id.editTextTextPassword2);
        edtNam = findViewById(R.id.editTextText3);
        edtLNam = findViewById(R.id.editTextText4);
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String email = edtUsr.getText().toString();
                String pwd = edtPwd.getText().toString();
                String name = edtNam.getText().toString();
                String lname = edtLNam.getText().toString();
                if(email.equals(String.valueOf(""))) {
                    edtUsr.setError("Enter an Email");
                } else if (pwd.equals(String.valueOf(""))) {
                    edtPwd.setError("Enter a Password");
                } else if (name.equals(String.valueOf(""))) {
                    edtNam.setError("Enter a Password");
                } else if (lname.equals(String.valueOf(""))) {
                    edtLNam.setError("Enter a Password");
                } else {
                    boolean isInserted = myDb.insertData(name,lname,email,pwd,"","","","","");
                    if(isInserted){
                        Toast.makeText(getApplicationContext(),"create successful", Toast.LENGTH_LONG).show();

                        Intent i = new Intent(Register.this, Login.class);
                        startActivity(i);
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(),"error insertion",Toast.LENGTH_LONG).show();
                    }
                }
            }
        });
    }
}