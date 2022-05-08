package com.arkay.guessimagequiz;

import java.math.BigInteger;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.Resources;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.arkay.guessimagequiz.beans.GameData;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.InterstitialAd;
import com.google.android.gms.appstate.AppStateManager;
import com.google.android.gms.appstate.AppStateStatusCodes;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesClient;
import com.google.android.gms.common.SignInButton;
import com.google.android.gms.common.api.ResultCallback;
import com.google.android.gms.games.Games;
import com.google.example.games.basegameutils.BaseGameActivity;


/**
 * Home Screen of this apps. Display Button to play quiz, Leaderboard, achievement, setting etc.
 * @author Arkay Apps
 *
 */
public class MenuHomeScreenActivity extends BaseGameActivity implements
		View.OnClickListener,  GooglePlayServicesClient.OnConnectionFailedListener, QuizPlayActivity.Listener, QuizCompletedActivity.Listener{

	
	private Button btnPlay, btnLeaderboard, btnAchievement, btnSetting;

	/** The interstitial ad. */
	public static final String PREFS_NAME = "preferences";

	 public static final String SOUND_EFFECT = "sound_effect";
	 public static final String VIBRATION = "vibration";
	 
	 public static final String TOTAL_SCORE = "total_score";
	 public static final String LEVEL ="level";
	 
	 //Achivement
	 public static final String LEVEL_COMPLETED = "level_completed";
	 public static final String IS_LAST_LEVEL_COMPLETED = "is_last_level_completed";
	 public static final String LAST_LEVEL_SCORE = "last_level_score";
	 public static final String HOW_MANY_TIMES_PLAY_QUIZ = "how_many_time_play_quiz";
	 public static final String COUNT_QUESTION_COMPLETED = "count_question_completed";
	 public static final String COUNT_RIGHT_ANSWARE_QUESTIONS = "count_right_answare_questions";
	 
	 public static final String VERY_CURIOUS_UNLOCK="is_very_curious_unlocked";
	 
	 final int RC_RESOLVE = 5000, RC_UNUSED = 5001;
	 
	 
	 QuizPlayActivity quizPlayActivity;
	 SharedPreferences settings;
	 QuizPlayActivity mQuizPlayFragment;
	 QuizCompletedActivity quizCompletedFragment;
	 private InterstitialAd interstitial;
	 private static final int OUR_STATE_KEY = 2;

	 
	 Context context;
	 public static final String REG_ID = "regId";
	 static final String TAG = "MenuHomeScreenActivity";
	 AsyncTask<Void, Void, String> shareRegidTask;
	 
	 ProgressDialog progress;
	 private GameData gameData;
	 private final Handler mHandler = new Handler();

	public MenuHomeScreenActivity() {
		 super(BaseGameActivity.CLIENT_GAMES |
		            BaseGameActivity.CLIENT_APPSTATE);
	       
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_menu_home);
		context = getApplicationContext();
				
		settings = getSharedPreferences(MenuHomeScreenActivity.PREFS_NAME, 0);
		gameData = new GameData(getSharedPreferences(MenuHomeScreenActivity.PREFS_NAME, 0));
		
		
		btnPlay = (Button) findViewById(R.id.btnPlay);
		btnPlay.setOnClickListener(this);
		btnLeaderboard = (Button) findViewById(R.id.btnLeaderboard);
		btnLeaderboard.setOnClickListener(this);
		
		btnAchievement = (Button) findViewById(R.id.btnAchievement);
		btnAchievement.setOnClickListener(this);
		
		btnSetting = (Button)findViewById(R.id.btnSetting);
		btnSetting.setOnClickListener(this);
		
		
		 mQuizPlayFragment = new QuizPlayActivity();
		 mQuizPlayFragment.setListener(this);

		 quizCompletedFragment = new QuizCompletedActivity();
		 quizCompletedFragment.setListener(this);
		 
		findViewById(R.id.sign_in_button).setOnClickListener(this);
		findViewById(R.id.sign_out_button).setOnClickListener(this);
		
		 // Create the interstitial.
	    interstitial = new InterstitialAd(this);
	    interstitial.setAdUnitId(getString(R.string.admob_intersitital));

	    // Create ad request.
	    Resources ress = getResources();
	    boolean isTestMode = ress.getBoolean(R.bool.istestmode);
	    AdRequest adRequest =null;
	    if(isTestMode){
	    	 // Request for Ads
	    	 System.out.println("Testing.... app");
	          adRequest = new AdRequest.Builder()
	         .addTestDevice(AdRequest.DEVICE_ID_EMULATOR)
	         .addTestDevice("B15149A4EC1ED23173A27B04134DD483")
	                .build();
	    }else{
	    	System.out.println("Live Apps");
	    	 adRequest = new AdRequest.Builder().build();
	    }

	    // Begin loading your interstitial.
	    interstitial.loadAd(adRequest);
	    
	    mHandler.postDelayed(mUpdateUITimerTask, 10 * 1000);
	    
	    progress = new ProgressDialog(this);
        progress.setTitle("Please Wait!!");
        progress.setMessage("Data Loading..");
        progress.setCancelable(false);
        progress.setProgressStyle(ProgressDialog.STYLE_SPINNER);
        progress.show();
        Handler delayhandler = new Handler();
		delayhandler.postDelayed(stopLoadDataDialogSomeTime, 5000);
		
        SignInButton mSignInButton = (SignInButton)findViewById(R.id.sign_in_button);
        
        mSignInButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // start the asynchronous sign in flow
            	System.out.println("Click on Sign-in");
                beginUserInitiatedSignIn();
            }
        });
 
   	 	
	}

	 Runnable stopLoadDataDialogSomeTime = new Runnable()
		{   public void run()
		    {   
			progress.dismiss();
		    }
		};
		
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.btnPlay:
			if(gameData.getLevelCompleted()==0 || gameData.getLevelCompleted()==1){
				if(isSignedIn()){
					unlockAchievement(R.string.achievement_beginner, "Beginner");
				}
			}
			getSupportFragmentManager().beginTransaction().replace( R.id.fragment_container, mQuizPlayFragment ).addToBackStack( "tag" ).commit();
			    
			break;
		case R.id.btnLeaderboard:
			if (isSignedIn()) {
				startActivityForResult(Games.Leaderboards.getAllLeaderboardsIntent(getApiClient()),RC_UNUSED);
			}
			break;
		case R.id.btnAchievement:
			if (isSignedIn()) {
				unlockAchievement(R.string.achievement_curious, "Curious");
				startActivityForResult(Games.Achievements.getAchievementsIntent(getApiClient()),RC_UNUSED);
			}
			break;

		case R.id.btnSetting:
			Intent playQuiz = new Intent(this, SettingActivity.class);
			startActivity(playQuiz);
			break;
		}
		if (v.getId() == R.id.sign_in_button) {
			beginUserInitiatedSignIn();
			findViewById(R.id.sign_in_button).setVisibility(View.GONE);
			findViewById(R.id.sign_out_button).setVisibility(View.VISIBLE);
			findViewById(R.id.sign_in_bar).setVisibility(View.GONE);
			findViewById(R.id.sign_out_bar).setVisibility(View.VISIBLE);
		} else if (v.getId() == R.id.sign_out_button) {
			// sign out.
			signOut();
			// show sign-in button, hide the sign-out button
			findViewById(R.id.sign_in_button).setVisibility(View.VISIBLE);
			findViewById(R.id.sign_out_button).setVisibility(View.GONE);
			findViewById(R.id.sign_out_bar).setVisibility(View.GONE);
			findViewById(R.id.sign_in_bar).setVisibility(View.VISIBLE);
		}

	}

	

	@Override
	public void onSignInFailed() {
		// TODO Auto-generated method stub
		System.out.println("Sing In Fail");
		findViewById(R.id.sign_in_button).setVisibility(View.VISIBLE);
		findViewById(R.id.sign_out_button).setVisibility(View.GONE);
		
		findViewById(R.id.sign_out_bar).setVisibility(View.GONE);
		findViewById(R.id.sign_in_bar).setVisibility(View.VISIBLE);
		progress.cancel();
	}

	@Override
	public void onSignInSucceeded() {
		// TODO Auto-generated method stub
		System.out.println("Sing In Succcess");
		findViewById(R.id.sign_in_button).setVisibility(View.GONE);
		findViewById(R.id.sign_out_button).setVisibility(View.VISIBLE);
		
		findViewById(R.id.sign_in_bar).setVisibility(View.GONE);
		findViewById(R.id.sign_out_bar).setVisibility(View.VISIBLE);
		
		loadFromCloud();
		
	}


	@Override
	public void onActivityResult(int requestCode, int resultCode, Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		System.out.println("Result Code: " + requestCode);
		
	}

	@Override
	public void onConnectionFailed(ConnectionResult arg0) {
		// TODO Auto-generated method stub
		System.out.println("Result Code: onConnectionFailed: " + arg0);
	}

	public void unlockAchievement(int achievementId, String fallbackString) {
		if (isSignedIn()) {
			Games.Achievements.unlock(getApiClient(), getString(achievementId));
		} else {
			Toast.makeText(this,
					getString(R.string.achievement) + ": " + fallbackString,
					Toast.LENGTH_LONG).show();
		}
	}

	@Override
	public void onStartGameRequested(boolean hardMode) {
		 getSupportFragmentManager().popBackStack();
		 this.findViewById(R.id.linearLayout1).setVisibility(View.VISIBLE);
	}

	@Override
	public void onShowAchievementsRequested() {
		if (isSignedIn()) {
            startActivityForResult(Games.Achievements.getAchievementsIntent(getApiClient()), RC_UNUSED);
        }
	}

	
	
	@Override
	public void onShowLeaderboardsRequested() {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onSignInButtonClicked() {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onSignOutButtonClicked() {
		// TODO Auto-generated method stub
		
	}
	boolean addList = false;

	@Override
	public void onBackPressed() {
		getSupportFragmentManager().popBackStack();
		this.findViewById(R.id.linearLayout1).setVisibility(View.VISIBLE);
		if(getSupportFragmentManager().getBackStackEntryCount()==0){
			super.onBackPressed();
		}
		
	}

	 // Invoke displayInterstitial() when you are ready to display an interstitial.
	  public void displayInterstitial() {
	    if (interstitial.isLoaded()) {
	      interstitial.show();
	    }
	  }
	  
	  private final Runnable mUpdateUITimerTask = new Runnable() {
		    public void run() {
		    	displayInterstitial();
		    	
		    }
		};
		
	@Override
	public void displyHomeScreen() {
		getSupportFragmentManager().popBackStack();
		this.findViewById(R.id.linearLayout1).setVisibility(View.VISIBLE);
	}

	 /**
     * Update leaderboards with the user's score.
     *
     * @param finalScore The score the user got.
     */
	@Override
    public void updateLeaderboards(int finalScore) {
		if (isSignedIn()) {
	    	if (finalScore >= 0) {
	            Games.Leaderboards.submitScore(getApiClient(), getString(R.string.leaderboard_guess_image_quiz),
	                   finalScore);
	            
	            byte[] scoreData = intToByteArray(finalScore); 
	            AppStateManager.update(getApiClient(), 1, scoreData);
	            

	        }
		}
    }
	public static byte[] intToByteArray(int a) {
	    return BigInteger.valueOf(a).toByteArray();
	}

	public static int byteArrayToInt(byte[] b) {
	    return new BigInteger(b).intValue();
	}
    

	 public  void loadFromCloud() {
	       // mLoadingDialog.show();
		  if(isSignedIn()){
	        AppStateManager.load(getGameHelper().getApiClient(), OUR_STATE_KEY).setResultCallback(mResultCallback);
		  }
	    }

	 public   void saveToCloud() {
		 if(isSignedIn()){
	        AppStateManager.update(getGameHelper().getApiClient(), OUR_STATE_KEY, gameData.toBytes());
		 }
	    }


	    ResultCallback<AppStateManager.StateResult> mResultCallback = new
	            ResultCallback<AppStateManager.StateResult>() {
	        @Override
	        public void onResult(AppStateManager.StateResult result) {
	            AppStateManager.StateConflictResult conflictResult = result.getConflictResult();
	            AppStateManager.StateLoadedResult loadedResult = result.getLoadedResult();
	            if (loadedResult != null) {
	            	processStateLoaded(loadedResult);
	            	
	            } else if (conflictResult != null) {
	                processStateConflict(conflictResult);
	            }
	        }
	    };
	    private void processStateConflict(AppStateManager.StateConflictResult result) {
	        // Need to resolve conflict between the two states.
	        // We do that by taking the union of the two sets of cleared levels,
	        // which means preserving the maximum star rating of each cleared
	        // level:
	        byte[] serverData = result.getServerData();
	        byte[] localData = result.getLocalData();

	        GameData localGame = new GameData(localData);
	        GameData serverGame = new GameData(serverData);
	        GameData resolvedGame = localGame.unionWith(serverGame);

	        AppStateManager.resolve(getApiClient(), result.getStateKey(), result.getResolvedVersion(),
	                resolvedGame.toBytes()).setResultCallback(mResultCallback);
	    }
	    
	    private void processStateLoaded(AppStateManager.StateLoadedResult result) {
	        
	        switch (result.getStatus().getStatusCode()) {
	        case AppStateStatusCodes.STATUS_OK:
	        	
	            // Data was successfully loaded from the cloud: merge with local data.
	            gameData = gameData.unionWith(new GameData(result.getLocalData()));
	            saveToCloud();
	            gameData.saveDataLocal(settings);
	            GameData tem = new GameData(result.getLocalData());
	            System.out.println("Game Data: "+tem);
	            System.out.println("Local Data: "+gameData);
	            progress.cancel();
	            
	            //mAlreadyLoadedState = true;
	            //hideAlertBar();
	            break;
	        case AppStateStatusCodes.STATUS_STATE_KEY_NOT_FOUND:
	            // key not found means there is no saved data. To us, this is the same as
	            // having empty data, so we treat this as a success.
	           // mAlreadyLoadedState = true;
	            //hideAlertBar();
	        	progress.cancel();
	            break;
	        case AppStateStatusCodes.STATUS_NETWORK_ERROR_NO_DATA:
	            // can't reach cloud, and we have no local state. Warn user that
	            // they may not see their existing progress, but any new progress won't be lost.
	            //showAlertBar(R.string.no_data_warning);
	        	progress.cancel();
	            break;
	        case AppStateStatusCodes.STATUS_NETWORK_ERROR_STALE_DATA:
	            // can't reach cloud, but we have locally cached data.
	            //showAlertBar(R.string.stale_data_warning);
	        	progress.cancel();
	            break;
	        case AppStateStatusCodes.STATUS_CLIENT_RECONNECT_REQUIRED:
	            // need to reconnect AppStateClient
	            reconnectClient();
	            break;
	        default:
	            // error
	            //showAlertBar(R.string.load_error_warning);
	            break;
	        }
	    }
		@Override
		public GameData getGameData() {
			return this.gameData;
		}

		@Override
		public void saveDataToCloud() {
			// TODO Auto-generated method stub
			saveToCloud();
		}

		@Override
		public QuizCompletedActivity getQuizCompletedFragment() {
			// TODO Auto-generated method stub
			return quizCompletedFragment;
		}
		
		@Override
		public void playAgain() {
			// TODO Auto-generated method stub
			getSupportFragmentManager().popBackStack();
			getSupportFragmentManager().beginTransaction().replace( R.id.fragment_container, mQuizPlayFragment ).addToBackStack( "tag" ).commit();
		}
		
		
		public boolean isConnectingToInternet(){
	        ConnectivityManager connectivity = (ConnectivityManager) this.getSystemService(Context.CONNECTIVITY_SERVICE);
	          if (connectivity != null)
	          {
	              NetworkInfo[] info = connectivity.getAllNetworkInfo();
	              if (info != null)
	                  for (int i = 0; i < info.length; i++)
	                      if (info[i].getState() == NetworkInfo.State.CONNECTED)
	                      {
	                          return true;
	                      }
	 
	          }
	          return false;
	    }

}
