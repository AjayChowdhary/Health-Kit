package com.example.ajaychowdhary.popoopopop;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {
    Button b;
    JSONObject jsonObject;
    JSONArray feeds;
    ListView lv;
    List<feeds_object> list_f;
    private TextView textView1;
    feeds_object f;
    Button b2;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        b = (Button) findViewById(R.id.button);
        b2=(Button)findViewById(R.id.button2);
        list_f=new ArrayList<>();
        lv=(ListView) findViewById(R.id.list);
        //textView1 = (TextView) findViewById(R.id.textView);
        b2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), second.class);
                startActivity(intent);
            }
        });
        b.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new JSONTask().execute();
            }


        });
    }

    class JSONTask extends AsyncTask<Void, Void, Void> {

        @Override
        protected Void doInBackground(Void... params) {
            BufferedReader reader = null;
            HttpURLConnection connection = null;
            StringBuffer buffer;

            try {

                URL url = new URL("https://api.thingspeak.com/channels/225903/feeds.json?results=10");
                connection = (HttpURLConnection) url.openConnection();
                connection.connect();
                InputStream stream = connection.getInputStream();
                reader = new BufferedReader(new InputStreamReader(stream));
                buffer = new StringBuffer();
                String line = "";
                while ((line = reader.readLine()) != null) {
                    buffer.append(line);
                }
                Log.d("response",buffer.toString());
                jsonObject = new JSONObject(buffer.toString());
                feeds = jsonObject.getJSONArray("feeds");
                for(int i=0;i<feeds.length();i++) {
                    f=new feeds_object();
                   f.temp=feeds.getJSONObject(i).getString("field1");
                    f.hbeat=feeds.getJSONObject(i).getString("field2");
                    f.date=feeds.getJSONObject(i).getString("created_at");
                    Log.d("cre",f.date+" ");
                    list_f.add(f);
                }
                return null;
            } catch (MalformedURLException e) {
                //  Toast.makeText(getApplicationContext(), "EXCEPTION", Toast.LENGTH_SHORT).show();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            } finally {
                if (connection != null)
                    connection.disconnect();
                try {
                    if (reader != null)
                        reader.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {

            super.onPostExecute(aVoid);
            Log.d("kdkd",list_f.get(0).date);
            CustomAdapter customAdapter=new CustomAdapter(MainActivity.this,list_f);
            lv.setAdapter(customAdapter);


        }


    }
}