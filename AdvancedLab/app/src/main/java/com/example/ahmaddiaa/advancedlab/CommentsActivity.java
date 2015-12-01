package com.example.ahmaddiaa.advancedlab;

import android.app.ListActivity;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ArrayAdapter;

import com.facebook.AccessToken;
import com.facebook.GraphRequest;
import com.facebook.GraphResponse;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Comment;

import java.util.ArrayList;


public class CommentsActivity extends ListActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_comments);
//        if (savedInstanceState == null) {
            Bundle extras = getIntent().getExtras();
//            if (extras != null) {
//                ArrayList<ArrayList<String>> Comments = (ArrayList<ArrayList<String>>)extras.get("Comments");
                ArrayList<String> Comments = (ArrayList<String>) extras.get("Comments");


                String[] friends = new String[Comments.size()];

                for(int i = 0 ; i < Comments.size(); i++)
                    friends[i] = Comments.get(i);

                ArrayAdapter<String> Adapter = new ArrayAdapter<String>(getListView().getContext(),android.R.layout.simple_list_item_1,friends);
                getListView().setAdapter(Adapter);

//            }
//        }
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_friends, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
