package com.davidadamojr.android.cliptext;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import org.apache.http.util.EncodingUtils;

/**
 * Created by ABACUS on 1/27/2015.
 */
public class WebViewFragment extends Fragment {

    private static final String CLIPTEXT_HOME = "http://www.cliptext.co/index-android.php";
    private static final String CLIPTEXT_POST = "http://www.cliptext.co/clipr.php";

    private WebView mWebView;

    @Override
    public void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);

        setRetainInstance(true);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup parent, Bundle savedInstanceState){
        View v = inflater.inflate(R.layout.fragment_webview, parent, false);

        mWebView = (WebView) v.findViewById(R.id.webview);
        mWebView.setWebViewClient(new CliptextWebViewClient());
        WebSettings webSettings = mWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);

        Intent intent = getActivity().getIntent();
        String action = intent.getAction();
        String type = intent.getType();

        if (Intent.ACTION_SEND.equals(action) && type.equals("text/plain")){
            String sharedText = intent.getStringExtra(Intent.EXTRA_TEXT);
            if (sharedText != null){
                String postData = "text=" + sharedText + "&mobile=true&url=I think this is interesting...";
                mWebView.postUrl(CLIPTEXT_POST, EncodingUtils.getBytes(postData, "BASE64"));
            } else {
                mWebView.loadUrl(CLIPTEXT_HOME);
            }
        } else {
            mWebView.loadUrl(CLIPTEXT_HOME);
        }
        return v;
    }

    private class CliptextWebViewClient extends WebViewClient {
        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url){
            if (Uri.parse(url).getHost().equals("www.cliptext.co") || Uri.parse(url).getHost().equals("api.twitter.com")){
                // This is allowed, so do not override; let my WebView load the page
                return false;
            }

            // otherwise, the link is not for a page connected to Cliptext, so launch another Activity that handles it
            Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(url));
            startActivity(intent);
            return true;
        }
    }
}
