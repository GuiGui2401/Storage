package com.example.testleon;

import android.media.Image;
import android.os.AsyncTask;
import android.util.Log;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.util.Base64;

import java.io.ByteArrayOutputStream;

public class apiTask extends AsyncTask<String, Void, String> {

    private static final String TAG = "ApiTask";
    private String Img;

    public apiTask(String img) {
        this.Img = img;
    }

    @Override
    protected String doInBackground(String... params) {
        String apiUrl = "http://192.168.43.200:5000/PostMaladie/";
        String jsonData = "{\"nom\": \"un_nom\"}"; // Remplacez "un_nom" par la valeur souhaitée

        try {
            URL url = new URL(apiUrl);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();

            connection.setRequestMethod("POST");
            connection.setRequestProperty("Content-Type", "application/json");
            connection.setDoOutput(true);

            OutputStream outputStream = connection.getOutputStream();
            outputStream.write(jsonData.getBytes());
            outputStream.flush();
            outputStream.close();

            int responseCode = connection.getResponseCode();

            if (responseCode == HttpURLConnection.HTTP_OK) {
                InputStream inputStream = connection.getInputStream();
                BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream));
                StringBuilder response = new StringBuilder();
                String line;

                while ((line = reader.readLine()) != null) {
                    response.append(line);
                }

                reader.close();
                return response.toString();
            } else {
                Log.e(TAG, "HTTP POST request failed with error code: " + responseCode);
            }

            connection.disconnect();
        } catch (IOException e) {
            Log.e(TAG, "Error in HTTP POST request: " + e.getMessage());
        }

        return null;
    }

    private String encodeImageToBase64(String imagePath) {
        Bitmap bitmap = BitmapFactory.decodeFile(imagePath);
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG, 100, byteArrayOutputStream);
        byte[] imageBytes = byteArrayOutputStream.toByteArray();
        return Base64.encodeToString(imageBytes, Base64.DEFAULT);
    }

    @Override
    protected void onPostExecute(String result) {
        if (result != null) {
            Log.d(TAG, "API response: " + result);
            // Traitez la réponse de l'API ici
        } else {
            Log.e(TAG, "No API response received");
            // Gérez l'absence de réponse de l'API ici
        }
    }
}
