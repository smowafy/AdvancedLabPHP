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


public class FriendsActivity extends ListActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_friends);
        if (savedInstanceState == null) {
            Bundle extras = getIntent().getExtras();
            if (extras != null) {
                AccessToken accessToken = (AccessToken)extras.get("accessToken");
                GraphRequest request1 = GraphRequest.newMyFriendsRequest(accessToken, new GraphRequest.GraphJSONArrayCallback() {
                    @Override
                    public void onCompleted(JSONArray jsonArray, GraphResponse graphResponse) {

                        try {
                            String[] friends = new String[jsonArray.length()];

                            for(int i = 0 ; i < jsonArray.length(); i++) {
                                JSONObject friend = jsonArray.getJSONObject(i);
                                friends[i] = friend.getString("name");
                            }
                            ArrayAdapter<String> Adapter = new ArrayAdapter<String>(getListView().getContext(),android.R.layout.simple_list_item_1,friends);
                            getListView().setAdapter(Adapter);

                            //info.setText(info.getText() + "\n" + "Friend's Name: " + friend.getString("name") + "\n" + " Friends ID: " + friend.getInt("id"));
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                });
                request1.executeAsync();
            }
        }
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
