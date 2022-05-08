package com.arkay.guessimagequiz.beans;

import java.util.List;

import android.content.Context;

/**
 * Bean of any quiz level this class decide level no and no of question with list of question.
 * @author Arkay
 *
 */
public class PlayQuizLevel {
	
	private int levelNo;
	private int noOfQuestion;
	private List<PlayQuizQuestion> question;
	public PlayQuizLevel(int levelNo, int noOfQuestion, Context context) {
		super();
		this.levelNo = levelNo;
		this.noOfQuestion = noOfQuestion;
	}
	
	public int getLevelNo() {
		return levelNo;
	}
	public void setLevelNo(int levelNo) {
		this.levelNo = levelNo;
	}
	public int getNoOfQuestion() {
		return noOfQuestion;
	}
	public void setNoOfQuestion(int noOfQuestion) {
		this.noOfQuestion = noOfQuestion;
	}

	public List<PlayQuizQuestion> getQuestion() {
		return question;
	}

	public void setQuestion(List<PlayQuizQuestion> question) {
		this.question = question;
	}
	/*public void setQuestionRendomFromDatabase(){
		
		question = questionsDao.getFourOptionQuestionRendom(getNoOfQuestion());
		Collections.shuffle(question);
	}*/
	

	
	
	
}
