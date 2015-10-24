package rainandroid.com.rainandroid;

import android.app.Activity;
import android.os.Bundle;
import android.util.Log;
import android.webkit.WebView;
import android.widget.TextView;

import logics.newLogic;

/**
 * Created by akeem on 10/24/2015.
 */
public class LandingPage extends Activity {

    String user, password;
    TextView username_1, password_1;
    WebView webview;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_main);

        Bundle extras = getIntent().getExtras();

        user = extras.getString("user");
        password = extras.getString("password");

        username_1 = (TextView) findViewById(R.id.textView);
        password_1 = (TextView) findViewById(R.id.textView2);
        webview = (WebView) findViewById(R.id.webView);


        webview.loadUrl("http://mark.journeytech.com");

        username_1.setText(user);
        password_1.setText(password);

       String rain_method = newLogic.displayString("Fuck");
        Log.d("ASD",""+rain_method);
    }

}