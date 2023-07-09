package com.example.testpfe;

import static android.content.ContentValues.TAG;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

public class signup extends AppCompatActivity {

    Button login;
    TextView signup;
    private FirebaseAuth mAuth;
    EditText name;
    EditText id;
    EditText email;
    EditText password1;
    EditText password2;
    EditText number;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        mAuth = FirebaseAuth.getInstance();
        name = findViewById(R.id.editTextText);
        id = findViewById(R.id.editTextText2);
        email = findViewById(R.id.editTextTextEmailAddress2);
        password1 = findViewById(R.id.editTextTextPassword);
        password2 = findViewById(R.id.editTextTextPassword8);
        number = findViewById(R.id.editTextPhone2);
        login= findViewById(R.id.button12);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String n = name.getText().toString();
                String newid = id.getText().toString();
                String em = email.getText().toString();
                String pwd1 = password1.getText().toString();
                String pwd2 = password2.getText().toString();
                String num = number.getText().toString();
                if(n.equals(String.valueOf("")))
                    name.setError("Enter name value");
                else if (newid.equals(String.valueOf("")))
                    id.setError("Enter unique id");
                else if (em.equals(String.valueOf("")))
                    email.setError("Enter email value");
                else if (pwd1.equals(String.valueOf("")))
                    password1.setError("Enter password");
                else if (pwd2.equals(String.valueOf("")))
                    password2.setError("enter confirmed password");
                else if (num.equals(String.valueOf("")))
                    number.setError("enter phone number");
                else if(!pwd1.equals(pwd2)) {
                    password1.setError("Different password");
                    password2.setError("Different password");
                } else {
                    createUser(em,pwd1);
                }
            }
        }
        );


        signup = findViewById(R.id.textView35);
        signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                    Intent i = new Intent(signup.this, Login.class);
                    startActivity(i);
                    finish();
            }
        });
    }

    @Override
    public void onStart() {
        super.onStart();
        // Check if user is signed in (non-null) and update UI accordingly.
        FirebaseUser currentUser = mAuth.getCurrentUser();
        if(currentUser != null){
            currentUser.reload();
        }
    }
    public void createUser(String eml,String pwd) {
        mAuth.createUserWithEmailAndPassword(eml, pwd)
                .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                    @Override
                    public void onComplete(@NonNull Task<AuthResult> task) {
                        if (task.isSuccessful()) {
                            // Sign in success, update UI with the signed-in user's information
                            Log.d(TAG, "createUserWithEmail:success");
                            FirebaseUser user = mAuth.getCurrentUser();
                            user.getPhoneNumber().replace(user.getPhoneNumber(),number.getText().toString());
                            updateUI(user);
                        } else {
                            // If sign in fails, display a message to the user.
                            Log.w(TAG, "createUserWithEmail:failure", task.getException());
                            Toast.makeText(signup.this, "Authentication failed.",
                                    Toast.LENGTH_SHORT).show();
                            updateUI(null);
                        }
                    }
                });
    }

    private void updateUI(FirebaseUser user) {
        if(user != null){
            Toast.makeText(this,"You Signed In successfully",Toast.LENGTH_LONG).show();
            startActivity(new Intent(this,accueil.class));
            finish();
        }else {
            Toast.makeText(this,"You Didnt signed in",Toast.LENGTH_LONG).show();
        }
    }
}