package com.davidadamojr.android.cliptext;

import android.support.v4.app.Fragment;

/**
 * Created by ABACUS on 1/27/2015.
 */
public class WebViewActivity extends SingleFragmentActivity {

    @Override
    protected Fragment createFragment(){
        return new WebViewFragment();
    }

    @Override
    protected int getLayoutResId(){ return R.layout.activity_fragment; }
}
