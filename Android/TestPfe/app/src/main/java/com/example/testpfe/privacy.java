package com.example.testpfe;


import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

public class privacy extends AppCompatActivity implements password.ExampleDialogListener, passord2.ExampleDialogListener, testpop.ExampleDialogListener, delete.ExampleDialogListener{

    ImageView back;
    TextView password1;
    TextView name;
    TextView id;
    TextView del;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_privacy);
        back = findViewById(R.id.imageView5);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(privacy.this, settings.class);
                startActivity(i);
                finish();
            }
        });
        password1 = findViewById(R.id.textView8);
        password1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openDialog();
            }
        });
        name = findViewById(R.id.textView9);
        name.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openDialog2();
            }
        });

        id = findViewById(R.id.textView10);
        id.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openDialog3();
            }
        });

        del = findViewById(R.id.textView11);
        del.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openDialog4();
            }
        });
    }
    public void openDialog() {
        password exampleDialog = new password();
        exampleDialog.show(getSupportFragmentManager(), "Change password");
    }

    public void openDialog2() {
        passord2 exampleDialog2 = new passord2();
        exampleDialog2.show(getSupportFragmentManager(), "Change name");
    }

    public void openDialog3() {
        testpop dialog = new testpop();
        dialog.show(getSupportFragmentManager(), "Change unique ID");
    }

    public void openDialog4() {
        delete dialog = new delete();
        dialog.show(getSupportFragmentManager(), "Delete account");
    }

    public void applyTexts(String username, String password) {
        Toast.makeText(getApplicationContext(),username + " " + password,Toast.LENGTH_LONG).show();
        Intent i = new Intent(privacy.this, Login.class);
        startActivity(i);
        finish();
    }
}