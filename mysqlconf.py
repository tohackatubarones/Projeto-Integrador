import mysql.connector

def criar_banco_de_dados():
    try:
        # Conectar ao servidor MySQL
        conexao = mysql.connector.connect(
            host="localhost",
            user="root",
            password="kali"
        )

        # Criar um cursor
        cursor = conexao.cursor()

        # Criar o banco de dados
        cursor.execute("CREATE DATABASE IF NOT EXISTS usuarios")

        # Fechar o cursor e a conexão
        cursor.close()
        conexao.close()

        print("Banco de dados 'usuarios' criado com sucesso!")

    except mysql.connector.Error as erro:
        print("Erro ao criar banco de dados:", erro)

def criar_tabela():
    try:
        # Conectar ao banco de dados 'usuarios'
        conexao = mysql.connector.connect(
            host="localhost",
            user="root",
            password="kali",
            database="usuarios"
        )

        # Criar um cursor
        cursor = conexao.cursor()

        # Criar a tabela 'usuarios'
        cursor.execute("CREATE TABLE IF NOT EXISTS usuarios (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) UNIQUE, password VARCHAR(255))")

        # Fechar o cursor e a conexão
        cursor.close()
        conexao.close()

        print("Tabela 'usuarios' criada com sucesso!")

    except mysql.connector.Error as erro:
        print("Erro ao criar tabela:", erro)

if __name__ == "__main__":
    # Chamar as funções para criar o banco de dados e a tabela
    criar_banco_de_dados()
    criar_tabela()
