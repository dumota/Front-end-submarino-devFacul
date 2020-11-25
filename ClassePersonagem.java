package com.alfa;

public enum ClassePersonagem {
	ARQUEIRO(new EspecialArqueiro()), MAGO(new EspecialMago()), GUERREIRO(new EspecialGuerreiro());
	
	private  Especial especial;
	
	private ClassePersonagem(Especial especial) {
		this.especial = especial;
	}
	
	public Especial getEspecial() {
		return especial;
	}
}
