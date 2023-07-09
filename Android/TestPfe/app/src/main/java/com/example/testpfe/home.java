package com.example.testpfe;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class home extends AppCompatActivity {

    BottomNavigationView btnNav;
    ImageView back;
    EditText name;
    EditText location;
    EditText culture;
    EditText size;
    Button submit;
    int SELECT_PICTURE = 200;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        back = findViewById(R.id.imageView4);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(home.this, accueil.class);
                startActivity(i);
                finish();
            }
        });

        name = findViewById(R.id.editTextTextPassword5);
        location = findViewById(R.id.editTextTextPassword4);
        culture = findViewById(R.id.editTextTextPassword3);
        size = findViewById(R.id.editTextTextPassword2);
        submit= findViewById(R.id.button);
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String nam = name.getText().toString();
                String loc = location.getText().toString();
                String cul = culture.getText().toString();
                String siz = size.getText().toString();
                if (nam.equals(String.valueOf("")))
                    name.setError("Enter the client's name");
                else if (loc.equals(String.valueOf("")))
                    location.setError("Enter the location of the site");
                else if (cul.equals(String.valueOf("")))
                    culture.setError("Enter the culture'sT name");
                else if (siz.equals(String.valueOf("")))
                    size.setError("Enter the plantation size");
                else {
                    Toast.makeText(getApplicationContext(),"Registration successful",Toast.LENGTH_LONG).show();
                    name.setText("");
                    location.setText("");
                    culture.setText("");
                    size.setText("");
                }
            }
        });

        btnNav = findViewById(R.id.btnNav);
        btnNav.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                if (item.getItemId() == R.id.item1) {
                    Intent i = new Intent(home.this, accueil.class);
                    startActivity(i);
                } else if(item.getItemId() == R.id.item2) {
                    Intent i2 = new Intent(home.this, home.class);
                    startActivity(i2);
                } else if (item.getItemId() == R.id.item3) {
                    Intent i3 = new Intent(home.this, accueil.class);
                    startActivity(i3);
                } else if (item.getItemId() == R.id.item4) {
                    Intent i4 = new Intent(home.this, rubrique.class);
                    startActivity(i4);
                } else if (item.getItemId() == R.id.item5) {
                    Intent i5 = new Intent(home.this, settings.class);
                    startActivity(i5);
                }
                return true;
            }
        });
    }
    void imageChooser() {
        Intent i = new Intent();
        i.setType("image/*");
        i.setAction(Intent.ACTION_GET_CONTENT);
        startActivityForResult(Intent.createChooser(i, "Select Picture"), SELECT_PICTURE);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if(resultCode == RESULT_OK) {

            Uri url = data.getData();
            if (null != url)
                Toast.makeText(getApplicationContext(),"Photo select",Toast.LENGTH_LONG);
        }
    }
}