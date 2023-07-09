package com.example.testpfe;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.MediaController;
import android.widget.VideoView;

public class Video1 extends AppCompatActivity {

    private VideoView video;
    ImageView back;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_video1);

        video = (VideoView) findViewById(R.id.videoView);
        MediaController mediaController = new MediaController(this);
        video.setMediaController(mediaController);

        Uri url = Uri.parse("android.resource://" + getPackageName() + "/" + R.raw.video);
        video.setVideoURI(url);

        back = findViewById(R.id.imageView40);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(Video1.this, accueil.class);
                startActivity(i);
                finish();
            }
        });
    }

    @Override
    protected void onResume() {
        super.onResume();
        video.start();
    }

    @Override
    protected void onPause() {
        super.onPause();
        video.suspend();
    }
}