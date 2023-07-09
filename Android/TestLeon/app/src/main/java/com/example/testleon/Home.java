package com.example.testleon;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

public class Home extends AppCompatActivity {

    BottomNavigationView btnNav;
    FloatingActionButton btnfloat;
    DatabaseHelper Db;
    TextView txt1,txt2,txt3;
    EditText edt1,edt2,edt3,edt4;
    Button save;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        Db = new DatabaseHelper(this);
        Cursor res = Db.getAllData();
        if (res.getCount() == 0)
            Toast.makeText(getApplicationContext(),"Nothing found",Toast.LENGTH_LONG).show();
        txt1 = findViewById(R.id.textView13);
        edt1 = findViewById(R.id.editTextTextEmailAddress3);
        edt2 = findViewById(R.id.editTextText);
        edt3 = findViewById(R.id.editTextTextPassword3);
        edt4 = findViewById(R.id.editTextText5);
        save = findViewById(R.id.button3);

        StringBuffer buffer = new StringBuffer();
        int i = 0;
        while (res.moveToNext() && i == 0) {
            buffer.append("Nom: "+ res.getString(1)+"\n");
            buffer.append("Prenom: "+ res.getString(2)+"\n");
            buffer.append("Email: "+ res.getString(3)+"\n");
            i++;
        }
        txt1.setText(buffer.toString());

        save.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String t1 = edt1.getText().toString(),t2 = edt2.getText().toString(),t3 = edt3.getText().toString(),t4 = edt4.getText().toString();
                if (t1.equals(String.valueOf("")))
                    txt1.setError("fell the field");
                else if (t2.equals(String.valueOf("")))
                    txt2.setError("feel the field");
                else if (t3.equals(String.valueOf("")))
                    txt3.setError("feel the field");
                else {
                    Db.updateData("1",t2,t4,t1,t3,"","","","","");
                    Toast.makeText(getApplicationContext(),"create successful", Toast.LENGTH_LONG).show();
                    txt1.setText(t1);
                    txt2.setText(t2);
                    txt3.setText(t3);
                }
            }
        });

        btnNav = findViewById(R.id.btnNav);
        btnNav.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                if (item.getItemId() == R.id.item1) {
                    Intent i = new Intent(Home.this, Home.class);
                    startActivity(i);
                    finish();
                } else if (item.getItemId() == R.id.item4) {
                    Intent i4 = new Intent(Home.this, Transaction.class);
                    startActivity(i4);
                    finish();
                } else if (item.getItemId() == R.id.item5) {
                    Intent i5 = new Intent(Home.this, com.example.testleon.sample.activities.MainActivity.class);
                    startActivity(i5);
                    finish();
                }
                return true;
            }
        });

        btnfloat = findViewById(R.id.fab);
        btnfloat.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(getApplicationContext(),"Coded by SUP'PTIC students",Toast.LENGTH_LONG).show();
            }
        });
    }
}