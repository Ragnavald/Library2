\c Library2;

CREATE TABLE IF NOT EXISTS usuarios (
  idUsuario SERIAL PRIMARY KEY,
  usuario JSON
);

CREATE TABLE IF NOT EXISTS pessoas (
  idPessoa SERIAL PRIMARY KEY,
  cliente JSON,
  fkUsuario INT REFERENCES usuarios(idUsuario)
);

CREATE TABLE IF NOT EXISTS fornecedores (
  idFornecedor SERIAL PRIMARY KEY,
  fornecedor JSON,
  fkUsuario INT REFERENCES usuarios(idUsuario)
);

CREATE TABLE IF NOT EXISTS livros (
  idLivro SERIAL PRIMARY KEY,
  livro JSON,
  fkFornecedor INT REFERENCES fornecedores(idFornecedor)
);

CREATE TABLE IF NOT EXISTS estoques (
  idEstoque SERIAL PRIMARY KEY,
  estoque JSON,
  fkLivro INT REFERENCES livros(idLivro)
);

CREATE TABLE IF NOT EXISTS emprestimos (
  idEmprestimo SERIAL PRIMARY KEY,
  emprestimo JSON,
  fkUsuario INT REFERENCES usuarios(idUsuario)
);

CREATE TABLE IF NOT EXISTS funcionarios (
  idFuncionario SERIAL PRIMARY KEY,
  funcionario JSON,
  fkPessoa INT REFERENCES pessoas(idPessoa)
);


/*Functions*/
CREATE OR REPLACE FUNCTION isBlock(email VARCHAR)
RETURNS BOOLEAN
LANGUAGE plpgsql
AS
$$
BEGIN
  IF EXISTS(SELECT 1 FROM usuarios WHERE usuario->>"email" = email AND usuario->> "isBLock" IS NOT NULL) THEN
    RETURN true;
  ELSE
    RETURN false;
END;
$$;

CREATE OR REPLACE FUNCTION userExists(email VARCHAR)
RETURNS BOOLEAN
LANGUAGE plpgsql
AS
$$
BEGIN
  IF EXISTS(SELECT 1 FROM usuarios WHERE usuario->>"email" = email) THEN
    RETURN true;
  ELSE
    RETURN false;
END;
$$;