package com.arkay.guessimagequiz.beans;

import java.util.ArrayList;

import android.graphics.Bitmap;

/**
 * This class is for question that is question and it's option with it't true answar.
 * @author Arkay Apps
 *
 */
public class PlayQuizQuestion {
	private String question;
	private String imagePath;
	private Bitmap questionBitmap;
	private ArrayList<String> options = new ArrayList<String>();
	private String trueAns;
	
	public PlayQuizQuestion(String question) {
		super();
		this.question = question;
	}


	public String getQuestion() {
		return question;
	}
	public void setQuestion(String question) {
		this.question = question;
	}
	
	public boolean addOption(String option){
		return this.options.add(option);
	}
	

	public ArrayList<String> getOptions() {
		return options;
	}

	public void setOptions(ArrayList<String> options) {
		this.options = options;
	}

	
	public String getTrueAns() {
		return trueAns;
	}

	public void setTrueAns(String trueAns) {
		this.trueAns = trueAns;
	}

	
	public String getImagePath() {
		return imagePath;
	}


	public void setImagePath(String imagePath) {
		this.imagePath = imagePath;
	}

	

	public Bitmap getQuestionBitmap() {
		return questionBitmap;
	}


	public void setQuestionBitmap(Bitmap questionBitmap) {
		this.questionBitmap = questionBitmap;
	}


	@Override
	public String toString() {
		return "Question: "+ question +" OptionS: "+options;
	}
	
	
	
		
}
