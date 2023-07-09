package com.example.testleon;

import static com.example.testleon.R.*;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.view.MenuItem;
import android.widget.TextView;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class Transaction extends AppCompatActivity {

    BottomNavigationView btnNav;
    DatabaseHelper Db;
    TextView txt1,txt2,txt3,txt4;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(layout.activity_transaction);

        txt1 = findViewById(id.textView17);
        txt2 = findViewById(id.textView18);
        txt3 = findViewById(id.textView19);
        txt4 = findViewById(id.textView20);
        Db = new DatabaseHelper(this);
        Cursor res = Db.getAllData();
        StringBuffer buffer = new StringBuffer();
        StringBuffer buffer2 = new StringBuffer();
        StringBuffer buffer3 = new StringBuffer();
        StringBuffer buffer4 = new StringBuffer();
        while (res.moveToNext()) {
            buffer.append(res.getString(5)+"\n");
            buffer2.append(res.getString(6)+"\n");
            buffer3.append(res.getString(7)+"\n");
            buffer4.append(res.getString(9)+"\n");
        }
        txt1.setText(buffer.toString());
        txt2.setText(buffer2.toString());
        txt3.setText(buffer3.toString());
        txt4.setText(buffer4.toString());

        btnNav = findViewById(id.btnNav);
        btnNav.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                if (item.getItemId() == id.item1) {
                    Intent i = new Intent(Transaction.this, Home.class);
                    startActivity(i);
                    finish();
                } else if (item.getItemId() == id.item4) {
                    Intent i4 = new Intent(Transaction.this, Transaction.class);
                    startActivity(i4);
                    finish();
                } else if (item.getItemId() == id.item5) {
                    Intent i5 = new Intent(Transaction.this, com.example.testleon.sample.activities.MainActivity.class);
                    startActivity(i5);
                    finish();
                }
                return true;
            }
        });
    }
}