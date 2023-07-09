package com.example.testleon.sample;

import android.content.Context;
import android.util.Log;
import android.webkit.JavascriptInterface;

import com.cinetpay.androidsdk.CinetPayWebAppInterface;

public class MyCinetPayWebAppInterface extends CinetPayWebAppInterface {

    public MyCinetPayWebAppInterface(Context c,
                                     String apikey,
                                     String site_id,
                                     String transaction_id,
                                     int amount,
                                     String currency,
                                     String description) {
        super(c, apikey, site_id, transaction_id, amount, currency, description);
    }

    @Override
    @JavascriptInterface
    public void onResponse(String response) {
        Log.d("MyCinetPayWebApp", response);
    }

    @Override
    @JavascriptInterface
    public void onError(String response) {
        Log.d("MyCinetPayWebApp", response);
    }
}
