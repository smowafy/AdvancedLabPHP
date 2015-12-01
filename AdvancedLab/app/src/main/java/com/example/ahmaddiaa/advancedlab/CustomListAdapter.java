package com.example.ahmaddiaa.advancedlab;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;


import org.w3c.dom.Text;

import java.util.ArrayList;

import static android.view.View.OnClickListener;


public class CustomListAdapter extends ArrayAdapter<String> {

    private Activity context;
    private ArrayList<String> Posts;
    ArrayList<ArrayList<String>> Comments;
    customButtonListener customListner;

    public class ViewHolder {

        public Button Comment;
        public Button showComments;
        public TextView post;
        public EditText commentBody;

    }
    public CustomListAdapter(Activity context, ArrayList<String> Posts, ArrayList<ArrayList<String>> Comments) {
        super(context, R.layout.mylist, Posts);
        this.context = context;
        this.Posts = Posts;
        this.Comments = Comments;
    }


    static int temp;

    public View getView(final int position, View view, ViewGroup parent) {
        ViewHolder viewholder;
        if(view == null) {
            LayoutInflater inflater = context.getLayoutInflater();
            view = inflater.inflate(R.layout.mylist, null, true);
            viewholder = new ViewHolder();
            viewholder.showComments = (Button) view.findViewById(R.id.button3);
            viewholder.post = (TextView) view.findViewById(R.id.textView);
            viewholder.post.setText(Posts.get(position));
            viewholder.commentBody = (EditText) view.findViewById(R.id.editText2);
            viewholder.Comment = (Button) view.findViewById(R.id.button2);
            view.setTag(viewholder);
        }else {
            viewholder = (ViewHolder) view.getTag();
        }
        final String temp = getItem(position);

        viewholder.showComments.setOnClickListener(new OnClickListener() {

            @Override
            public void onClick(View v) {
                if (customListner != null) {
                    customListner.onButtonClickListner(position,temp);
                }

            }
        });
        final ViewHolder vh = viewholder;
        viewholder.Comment.setOnClickListener(new OnClickListener() {

            @Override
            public void onClick(View v) {
                if (customListner != null) {
                    final String temp2 = vh.commentBody.getText().toString();
                    customListner.onButton2ClickListner(position,temp2);
                    vh.commentBody.setText("");
                }

            }
        });

        return view;
    }
    public void setCustomButtonListner(customButtonListener listener) {
        this.customListner = listener;
    }

}