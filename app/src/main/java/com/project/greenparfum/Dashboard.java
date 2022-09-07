package com.project.greenparfum;

import androidx.appcompat.app.AppCompatActivity;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.content.Intent;
import android.os.Bundle;
import android.view.KeyEvent;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import com.project.greenparfum.Config.ServerAccess;

public class Dashboard extends AppCompatActivity {
    SwipeRefreshLayout swlayout;
    String urlWeb;
    WebView webView;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);
//        this.webView = (WebView) findViewById(R.id.webview);
//        WebSettings webSettings = webView.getSettings();
//        webSettings.setJavaScriptEnabled(true);
//        webView.setWebViewClient(new WebViewClient());
//        webView.loadUrl("http://greenparfum.site/");

        this.webView = (WebView) findViewById(R.id.webview);
        this.swlayout = (SwipeRefreshLayout) findViewById(R.id.swlayout);
        this.webView.getSettings().setJavaScriptEnabled(true);
        this.webView.loadUrl(ServerAccess.BASE_URL);
        this.webView.setWebViewClient(new WebViewClient() {
            public boolean shouldOverrideUrlLoading(WebView view, String url) {
                Dashboard.this.urlWeb = url;
                if (!url.contains("activity_a://a")) {
                    return false;
                }
                String[] id = url.split("/");
                Intent intent = new Intent(getApplicationContext(), Print.class);
                intent.putExtra("id", id[id.length - 1]);
                startActivity(intent);
                return true;
            }
        });
        this.webView.setWebChromeClient(new WebChromeClient());
        this.swlayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            public void onRefresh() {
                Dashboard.this.webView.loadUrl(Dashboard.this.urlWeb);
                Dashboard.this.swlayout.setRefreshing(false);
            }
        });
    }
    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if (event.getAction() != 0 || keyCode != 4) {
            return super.onKeyDown(keyCode, event);
        }
        if (this.webView.canGoBack()) {
            this.webView.goBack();
            return true;
        }
        finish();
        return true;
    }
}