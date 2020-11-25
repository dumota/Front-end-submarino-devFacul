package com.alfa;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class PersonagemDAO {

	private Connection connection;

	public PersonagemDAO() throws SQLException {
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");
			connection = DriverManager.getConnection(
					"jdbc:mysql://localhost:3306/javadb?useTimezone=true&serverTimezone=UTC", "root",
					"kaiabesuruaraiama");

		} catch (Exception e) {
			throw new SQLException(e.getMessage());
		}
	}

	public Connection getConnection() {
		return connection;
	}

	public void inserir(Personagem personagem)throws SQLException {
		ResultSet rs = connection.prepareStatement("select max(id) from personagem").executeQuery();
		int id= 0;
		while(rs.next()) {
			id = rs.getInt(1)+1;
			
			String sql = "insert into personagem value(?,?,?,?)";
			PreparedStatement ps = connection.prepareStatement(sql);
			ps.setInt(1, id);
			ps.setString(2, personagem.getNome());
			ps.setInt(3, personagem.getPassos());
			ps.setInt(4, personagem.getClasse().ordinal());
			ps.execute();
		}
		rs.close();
	}
	
	public void atualizar(Personagem personagem) throws SQLException {
		String sql = "update personagem set nome= ?,passos=?,classe=? where id = ?";
		PreparedStatement ps = connection.prepareStatement(sql);
		ps.setString(1, personagem.getNome());
		ps.setInt(2, personagem.getPassos());
		ps.setInt(3, personagem.getClasse().ordinal());
		ps.setInt(4, personagem.getId());
		ps.execute();
	}
	
	public void deletar(int id) throws SQLException {
		String sql = "delete from personagem where id=?";
		PreparedStatement ps = connection.prepareStatement(sql);
		ps.setInt(1, id);
		ps.execute();
	}

	public Personagem consultarPorId(int id) throws SQLException {
		Personagem p = new  Personagem();
		
		String sql = "select * from personagem where id =?";
		PreparedStatement ps = connection.prepareStatement(sql);
		ps.setInt(1, id);
		ResultSet rs = ps.executeQuery();
		
		while(rs.next()) {
			p.setId(rs.getInt("id"));
			p.setNome(rs.getString("nome"));
			p.setPassos(rs.getInt("passos"));
			p.setClasse(ClassePersonagem.values()[rs.getInt("classe")]);
			
		}
		rs.close();
		
		return p;
	}
	
	public List<Personagem> consultarPorNome(String nome)throws SQLException{
		List<Personagem> personagens = new ArrayList<Personagem>();
		
		String sql ="select * from personagem where nome like ?";
		PreparedStatement ps = connection.prepareStatement(sql);
		ps.setString(1,"%"+nome+"%");
		ResultSet rs = ps.executeQuery();
		
		while(rs.next()) {
			Personagem p = new Personagem();
			p.setId(rs.getInt("id"));
			p.setNome(rs.getString("nome"));
			p.setPassos(rs.getInt("passos"));
			p.setClasse(ClassePersonagem.values()[rs.getInt("classe")]);
			personagens.add(p);
		}
		rs.close();
		
		return personagens;
		
	}
	
	public List<Personagem> listarTodos()throws SQLException{
		List<Personagem> personagens = new ArrayList<Personagem>();
		ResultSet rs = connection.prepareStatement("select * from personagem").executeQuery();
		while(rs.next()) {
			Personagem p = new Personagem();
			p.setId(rs.getInt("id"));
			p.setNome(rs.getString("nome"));
			p.setPassos(rs.getInt("passos"));
			p.setClasse(ClassePersonagem.values()[rs.getInt("classe")]);
			personagens.add(p);
		
		}
		rs.close();
		return personagens;
	}
		
}
