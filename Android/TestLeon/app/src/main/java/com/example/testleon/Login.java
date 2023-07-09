package com.example.testleon;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class Login extends AppCompatActivity {

    TextView signup;
    Button submit;
    EditText edtUsr,edtPwd;
    DatabaseHelper Db;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        signup = findViewById(R.id.textView3);
        signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(Login.this, Register.class);
                startActivity(i);
                finish();
            }
        });

        Db = new DatabaseHelper(this);
        submit = findViewById(R.id.button);
        edtUsr = findViewById(R.id.editTextTextEmailAddress);
        edtPwd = findViewById(R.id.editTextTextPassword);

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String email = edtUsr.getText().toString();
                String pwd = edtPwd.getText().toString();
                int tbool = 0;
                if(email.equals(String.valueOf(""))) {
                    edtUsr.setError("Enter an Email");
                } else if (pwd.equals(String.valueOf(""))) {
                    edtPwd.setError("Enter a Password");
                } else {
                    Cursor res = Db.getAllData();
                    if (res.getCount() == 0)
                        Toast.makeText(getApplicationContext(),"Nothing found",Toast.LENGTH_LONG).show();
                    while(res.moveToNext()) {
                        if (email.equals(res.getString(3)) && pwd.equals(res.getString(5))) {
                            Toast.makeText(getApplicationContext(),"Login successful",Toast.LENGTH_LONG).show();
                            tbool = 1;
                        }
                    }
                        Toast.makeText(getApplicationContext(),"Login successful",Toast.LENGTH_LONG).show();
                        Intent i = new Intent(Login.this, Home.class);
                        startActivity(i);
                        finish();
                }
            }
        });
    }
}