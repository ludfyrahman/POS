package com.project.greenparfum.Config;

import android.app.Application;
import android.text.TextUtils;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

public class AppController extends Application {
    private static AppController instance;
    private final String TAG = AppController.class.getSimpleName();
    RequestQueue mRequest;

    public static AppController getInstance() {
        return instance;
    }

    public void onCreate() {
        super.onCreate();
        instance = this;
    }

    private RequestQueue getmRequest() {
        if (this.mRequest == null) {
            this.mRequest = Volley.newRequestQueue(getApplicationContext());
        }
        return this.mRequest;
    }

    public <I> void addToRequestQueue(Request<I> req, String tag) {
        req.setTag(TextUtils.isEmpty(tag) ? this.TAG : tag);
        getmRequest().add(req);
    }

    public <I> void addToRequestQueue(Request<I> req) {
        req.setTag(this.TAG);
        getmRequest().add(req);
    }

    public void cancelAllRequestQueue(Object req) {
        RequestQueue requestQueue = this.mRequest;
        if (requestQueue != null) {
            requestQueue.cancelAll(req);
        }
    }
}
