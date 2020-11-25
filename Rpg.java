package com.alfa;

import java.sql.SQLException;
import java.util.List;

public class Rpg {

	public static void main(String[] args) throws SQLException {
		PersonagemDAO dao = new PersonagemDAO();
		try {

			// System.out.println(dao.consultarPorId(1).toString());

			// Personagem saitama = new Personagem(1, "jaum", ClassePersonagem.GUERREIRO,
			// 51);

			// dao.inserir(saitama);
			// dao.atualizar(saitama);
			// dao.deletar(2);
			// dao.consultarPorNome("ma").forEach( p ->{
			// System.out.println(p.toString());
			// });;

			// dao.listarTodos().forEach(p -> {
			// System.out.println(p.toString());
			// });
			// ;
			
			Personagem p = dao.consultarPorId(4);
			System.out.println(p.toString());
			
			jogar(p);

		} catch (Exception e) {
			System.out.println(e.toString());
		}
		dao.getConnection().close();

	}

	private static void jogar(Personagem p) {
		try {
			System.out.println(p.golpeComum());
			System.out.println(p.golpeEspecial());

			if ((p.getPassos() % 2) == 1) {
				throw new ArmadilhaException();
			}

		} catch (ArmadilhaException e) {
			System.out.println(e.toString());
		}
	}

}
