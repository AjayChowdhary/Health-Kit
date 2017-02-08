package com.example.ajaychowdhary.popoopopop;

import android.content.Context;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.telephony.SmsManager;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class second extends AppCompatActivity {
    private String number;
    private String message;
    Button sendb;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_second);
        sendb=(Button)findViewById(R.id.button3);
        sendb.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                message="APPOINTMENT TO MADE BY USER AJAY";
                number="9582748532";
                sendSMSMessage();

            }
        });


    }
    protected void sendSMSMessage() {

        Log.i("Send SMS", message + " " + number);


        try {

            SmsManager smsManager = SmsManager.getDefault();
            smsManager.sendTextMessage(number, null, message, null, null);
            Toast.makeText(getApplicationContext(), "SMS sent.", Toast.LENGTH_LONG).show();
        }

        catch (Exception e) {
            Toast.makeText(getApplicationContext(), "SMS faild, please try again.", Toast.LENGTH_LONG).show();
            e.printStackTrace();
        }
    }

}
