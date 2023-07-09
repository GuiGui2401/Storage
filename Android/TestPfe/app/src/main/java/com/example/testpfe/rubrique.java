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
import android.widget.ImageView;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class rubrique extends AppCompatActivity {

    BottomNavigationView btnNav;
    ImageView back;
    int SELECT_PICTURE = 200;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_rubrique);

        back = findViewById(R.id.imageView27);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(rubrique.this, accueil.class);
                startActivity(i);
                finish();
            }
        });


        btnNav = findViewById(R.id.btnNav);
        btnNav.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                if (item.getItemId() == R.id.item1) {
                    Intent i = new Intent(rubrique.this, accueil.class);
                    startActivity(i);
                } else if(item.getItemId() == R.id.item2) {
                    Intent i2 = new Intent(rubrique.this, home.class);
                    startActivity(i2);
                } else if (item.getItemId() == R.id.item3) {
                    Intent i3 = new Intent(rubrique.this, accueil.class);
                    startActivity(i3);
                } else if (item.getItemId() == R.id.item4) {
                    Intent i4 = new Intent(rubrique.this, rubrique.class);
                    startActivity(i4);
                } else if (item.getItemId() == R.id.item5) {
                    Intent i5 = new Intent(rubrique.this, settings.class);
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