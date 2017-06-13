package com.example.ajaychowdhary.ajabk;

import android.os.AsyncTask;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.animation.AlphaAnimation;
import android.view.animation.Animation;
import android.widget.TextView;

import java.util.Timer;
import java.util.TimerTask;

public class MainActivity extends AppCompatActivity {
    TextView textView;
    String s;
    static int i = 0;
    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        final TextView st=(TextView) findViewById(R.id.tt);

        final Timer t = new Timer();
        t.schedule(new TimerTask() {
            @Override
            public void run() {
                Log.i("aaaaaaaa",i+"");
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        st.setText(i+"");
                                           }
                });
                i++;
                if(i==10){
                    t.cancel();
                    i=0;
                }


            }
        }, 1000,1000);
    }
}
