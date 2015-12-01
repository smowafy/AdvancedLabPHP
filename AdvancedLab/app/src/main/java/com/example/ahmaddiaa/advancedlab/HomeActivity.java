package com.example.ahmaddiaa.advancedlab;

import android.app.ListActivity;
import android.content.Intent;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.facebook.AccessToken;
import com.facebook.GraphRequest;
import com.facebook.GraphResponse;
import com.jeremyfeinstein.slidingmenu.lib.app.SlidingFragmentActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;


public class HomeActivity extends ListActivity implements customButtonListener {


    private TextView info;
    String name = "Ahmad Diaa";
    static ArrayList<String> Posts = new ArrayList<String>();
    static ArrayList<ArrayList<String>> Comments = new ArrayList<ArrayList<String>>();


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        TextView txtTitle = (TextView)findViewById(R.id.Name);
        txtTitle.setText(name);


//        info = (TextView)findViewById(R.id.info);

        final Intent intent = new Intent(this, HomeActivity.class);
        if(savedInstanceState == null)
            Posts = (ArrayList<String>) getIntent().getExtras().get("Posts");

        final Button button = (Button) findViewById(R.id.button);
        final EditText edit = (EditText) findViewById(R.id.editText);
        ArrayList <String> f = new ArrayList<>();
        f.add("hiii");
        f.add("hiii12");
        Comments.add(f);
        Comments.add(new ArrayList<String>());


        button.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Posts.add(name + ": " + edit.getText().toString());
                intent.putExtra("Posts", Posts);

                startActivity(intent);
            }
        });

        CustomListAdapter adapter = new CustomListAdapter(HomeActivity.this, Posts,  Comments);
        adapter.setCustomButtonListner(HomeActivity.this);
        getListView().setAdapter(adapter);

    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_home, menu);
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

    @Override
    public void onButtonClickListner(int position, String value) {
        final Intent intent = new Intent(this, CommentsActivity.class);
        if(Comments.get(position) != null)
            intent.putExtra("Comments", Comments.get(position));
        else
            intent.putExtra("Comments",new ArrayList<String>());
        startActivity(intent);
    }

    @Override
    public void onButton2ClickListner(int position, String value) {
        while(Comments.get(position) == null)
            Comments.add(new ArrayList<String>());
        ArrayList <String> curr;
        curr = Comments.get(position);
        curr.add("ahmad diaa: " + value);
        Comments.set(position,curr);

    }
}
