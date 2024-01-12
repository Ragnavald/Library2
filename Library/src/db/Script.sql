\c Library2;

CREATE TABLE IF NOT EXISTS usuarios (
  idUsuario SERIAL PRIMARY KEY,
  usuario JSONB
);

CREATE TABLE IF NOT EXISTS pessoas (
  idPessoa SERIAL PRIMARY KEY,
  cliente JSONB,
  fkUsuario INT REFERENCES usuarios(idUsuario)
);

CREATE TABLE IF NOT EXISTS fornecedores (
  idFornecedor SERIAL PRIMARY KEY,
  fornecedor JSONB,
  fkUsuario INT REFERENCES usuarios(idUsuario)
);

CREATE TABLE IF NOT EXISTS livros (
  idLivro SERIAL PRIMARY KEY,
  livro JSONB,
  fkFornecedor INT REFERENCES fornecedores(idFornecedor)
);

CREATE TABLE IF NOT EXISTS estoques (
  idEstoque SERIAL PRIMARY KEY,
  estoque JSONB,
  fkLivro INT REFERENCES livros(idLivro)
);

CREATE TABLE IF NOT EXISTS emprestimos (
  idEmprestimo SERIAL PRIMARY KEY,
  emprestimo JSONB,
  fkUsuario INT REFERENCES usuarios(idUsuario)
);

CREATE TABLE IF NOT EXISTS funcionarios (
  idFuncionario SERIAL PRIMARY KEY,
  funcionario JSONB,
  fkPessoa INT REFERENCES pessoas(idPessoa)
);

CREATE OR REPLACE PROCEDURE decrement_attempts(email TEXT, dateNow TEXT)
RETURN BOOLEAN AS $$
BEGIN
IF ((SELECT (usuario->>'attempts')::int FROM usuarios WHERE (usuario->>'email') = email) > 0) THEN
  UPDATE usuarios
        SET usuario = jsonb_set(
            usuario,
            '{attempts}',
            to_jsonb((SELECT ((usuario->>'attempts')::int - 1)::text FROM usuarios)),
            false
        );
        RETURN true;
ELSE
UPDATE usuarios
  SET usuario = jsonb_set(jsonb_set(usuario,'{isBlock}',true::BOOLEAN,false),'{data}');
