package com.alfa;

public class Personagem {
	
	private int id;
	private String nome;
	private int passos;
	private ClassePersonagem classe;
	

	public Personagem() {
		// TODO Auto-generated constructor stub
	}
	
	
	public Personagem(String nome, ClassePersonagem classe, int passos) {
		this.nome = nome;
		this.classe = classe;
		this.passos = passos;
	}
	
	
	
	public Personagem(int id, String nome, ClassePersonagem classe, int passos) {
		this.id = id;
		this.nome = nome;
		this.classe = classe;
		this.passos = passos;
	}



	
	
	public int getId() {
		return id;
	}


	public void setId(int id) {
		this.id = id;
	}


	public String getNome() {
		return nome;
	}


	public void setNome(String nome) {
		this.nome = nome;
	}


	public ClassePersonagem getClasse() {
		return classe;
	}


	public void setClasse(ClassePersonagem classe) {
		this.classe = classe;
	}


	public int getPassos() {
		return passos;
	}


	public void setPassos(int passos) {
		this.passos = passos;
	}


	public String golpeComum() {
		return "Golpe normal";
	}
	
	public String golpeEspecial() {
		return classe.getEspecial().soltarESpecial();
	}	
	
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return id+" "+nome+" "+passos+" "+classe.toString();
	}
}
