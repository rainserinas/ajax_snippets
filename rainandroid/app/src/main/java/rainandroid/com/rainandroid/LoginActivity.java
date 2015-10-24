package rainandroid.com.rainandroid;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

/**
 * Created by akeem on 10/24/2015.
 */
public class LoginActivity extends Activity {

    Button login_button;
    EditText username, password;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_view);

        login_button = (Button) findViewById(R.id.btnLogin);
        username = (EditText) findViewById(R.id.editText);
        password = (EditText) findViewById(R.id.editText2);

        login_button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                String user = username.getText().toString().toLowerCase();
                String pass = password.getText().toString();


                if (user.equals("raineir") && pass.equals("raineir")) {

                    //Change Page
                    Intent i = new Intent(LoginActivity.this, LandingPage.class);
                    i.putExtra("user", user);
                    i.putExtra("password", pass);
                    startActivity(i);
                    finish();

                } else {
                    Toast.makeText(getApplicationContext(), "Incorrect Username/Password", Toast.LENGTH_SHORT).show();
                }

            }
        });

    }

    @Override
    protected void onPause() {
        super.onPause();
    }

    @Override
    protected void onResume() {
        super.onResume();
    }
}




