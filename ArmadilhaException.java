package com.alfa;

@SuppressWarnings("serial")
public class ArmadilhaException extends Exception {
	@Override
	public String toString() {
		return "Você caiu em uma armadilha!";
	}
}
