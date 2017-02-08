package com.example.ajaychowdhary.popoopopop;

import android.app.Activity;
import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.LinearLayout;
import android.widget.TextView;

import java.util.List;

/**
 * Created by AJAY CHOWDHARY on 07-02-2017.
 */

public class CustomAdapter extends ArrayAdapter {
    Activity context;
    LayoutInflater layoutInflater;
    List<feeds_object> f;

    public CustomAdapter(Activity context, List<feeds_object> f) {
        super(context, R.layout.item,f);
        this.context=context;
        this.f=f;
    }




    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        layoutInflater= LayoutInflater.from(context);
        LayoutInflater inflater = context.getLayoutInflater();
        View listViewItem;
        listViewItem=inflater.inflate(R.layout.item, null, true);
        TextView date=(TextView)listViewItem.findViewById(R.id.date);
        TextView temp=(TextView)listViewItem.findViewById(R.id.temp);
        TextView beat=(TextView)listViewItem.findViewById(R.id.heartbeat);
        Log.d("stua",f.get(position).date+"m;l");
        date.setText(f.get(position).date);
        temp.setText(f.get(position).temp);
        beat.setText(f.get(position).hbeat);
        return listViewItem;

    }
}
