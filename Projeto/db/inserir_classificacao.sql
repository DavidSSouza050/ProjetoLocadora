-- CADASTRO DE GENEROS 

INSERT INTO tbl_classificacao (classificacao) Values ('LIVRE');
INSERT INTO tbl_classificacao (classificacao) Values ('10 ANOS');
INSERT INTO tbl_classificacao (classificacao) Values ('12 ANOS');
INSERT INTO tbl_classificacao (classificacao) Values ('14 ANOS');
INSERT INTO tbl_classificacao (classificacao) Values ('16 ANOS');
INSERT INTO tbl_classificacao (classificacao) Values ('18 ANOS');

-- CADASTRO DE DIRETORES EXTERMINADOR DO FUTURO E PREDADOR

INSERT INTO tbl_diretor (diretor) VALUES ('James Cameron'); -- EX
INSERT INTO tbl_diretor (diretor) VALUES ('John McTiernan');-- PREDADOR

-- CADASTRO DE GENERO

INSERT INTO tbl_genero (genero) VALUES ('Ação');
INSERT INTO tbl_genero (genero) VALUES ('Animação'); --
INSERT INTO tbl_genero (genero) VALUES ('Aventura');
INSERT INTO tbl_genero (genero) VALUES ('Cinema de arte');
INSERT INTO tbl_genero (genero) VALUES ('Chanchada');
INSERT INTO tbl_genero (genero) VALUES ('Cinema catástrofe');
INSERT INTO tbl_genero (genero) VALUES ('Comédia');
INSERT INTO tbl_genero (genero) VALUES ('Comédia romântica');
INSERT INTO tbl_genero (genero) VALUES ('Comédia dramática');
INSERT INTO tbl_genero (genero) VALUES ('Comédia de ação');
INSERT INTO tbl_genero (genero) VALUES ('Dança');
INSERT INTO tbl_genero (genero) VALUES ('Documentário');
INSERT INTO tbl_genero (genero) VALUES ('Docuficção');
INSERT INTO tbl_genero (genero) VALUES ('Drama');
INSERT INTO tbl_genero (genero) VALUES ('Espionagem');
INSERT INTO tbl_genero (genero) VALUES ('Faroeste (ou western)');
INSERT INTO tbl_genero (genero) VALUES ('Fantasia científica');
INSERT INTO tbl_genero (genero) VALUES ('Ficção científica');
INSERT INTO tbl_genero (genero) VALUES ('Filmes de guerra'); --
INSERT INTO tbl_genero (genero) VALUES ('Musical');
INSERT INTO tbl_genero (genero) VALUES ('Filme policial');
INSERT INTO tbl_genero (genero) VALUES ('Romance');
INSERT INTO tbl_genero (genero) VALUES ('Seriado');
INSERT INTO tbl_genero (genero) VALUES ('Suspense');
INSERT INTO tbl_genero (genero) VALUES ('Terror (ou horror)');
INSERT INTO tbl_genero (genero) VALUES ('Épico');
INSERT INTO tbl_genero (genero) VALUES ('Cyberpunk');
INSERT INTO tbl_genero (genero) VALUES ('Tech noir');
INSERT INTO tbl_genero (genero) VALUES ('Épico');

-- DISTRIBUIDORA DO FILME EXTERMINADOR DO FUTURO E PREDADOR

INSERT INTO tbl_ditribuidora (distribuidora) VALUES ('Orion Pictures'); -- EXTERMINADOR 1
INSERT INTO tbl_ditribuidora (distribuidora) VALUES ('TriStar Pictures'); -- EXTERMINADOR 2
INSERT INTO tbl_ditribuidora (distribuidora) VALUES ('20th Century Fox'); -- PRERADADOR
INSERT INTO tbl_ditribuidora (distribuidora) VALUES ('Walt Disney Studios Motion Pictures'); -- Vingadores
INSERT INTO tbl_ditribuidora (distribuidora) VALUES (' Warner Home Video'); -- Vingadores

SELECT * FROM tbl_ditribuidora;
-- EXTERMINADOR DO FUTURO 1

INSERT INTO tbl_filme (titulo_filme, descricao, preco_filme, imagem_filme, duracao, cod_classificacao, cod_distribuidora) 
			Values    ('O Exterminador do Futuro', 
						'Num futuro próximo, a guerra entre humanos e máquinas foi deflagrada. Com a tecnologia a seu dispor, um plano inusitado é arquitetado pelas máquinas ao enviar para o passado um androide com a missão de matar a mãe daquele que viria a se transformar num líder e seu pior inimigo. Contudo, os humanos também conseguem enviar um representante para proteger a mulher e tentar garantir o futuro da humanidade.',
                        preco_filme = REPLACE( '50,80', ',', '.' ), 'esterminador_do_futuro.png', '107 minutos', 4, 1); 

-- EXTERMINADOR DO FUTURO 2

INSERT INTO tbl_filme (titulo_filme, descricao, preco_filme, imagem_filme, duracao, cod_classificacao, cod_distribuidora) 
			Values    ('O Exterminador do Futuro 2', 
						'Uma criança destinada a ser líder (Edward Furlong) já nasceu, mas é infeliz por viver com pais adotivos, pois foi privado da companhia da mãe (Linda Hamilton), que foi considerada louca quando falou de um exterminador vindo do futuro. Neste contexto, um andróide (Arnold Schwarzenegger) vem do futuro, mais exatamente um modelo T-800 igual ao filme original, para proteger o garoto, mas existe um problema: o mais avançado andróide existente no futuro, um modelo T-1000 (Robert Patrick), que é feito de "metal líquido", não pode ter nenhum dano permanente e pode assumir a forma que desejar, também veio para o passado com a missão de matar o menino.',
                        preco_filme = REPLACE( '50,80', ',', '.' ), 'exterminador_do_futuro_2.jpg', '136 minutos', 3, 2); 
                        
INSERT INTO tbl_filme (titulo_filme, descricao, preco_filme, imagem_filme, duracao, cod_classificacao, cod_distribuidora) 
			Values    ('Vingadores: Guerra Infinita', 
						'O maior e mais mortal confronto de todos os tempos. Os Vingadores e seus aliados Super Heróis devem se dispor a sacrificar tudo em uma tentativa de derrotar o poderoso Thanos antes que seu ataque de devastação e ruína dê um fim ao universo.',
                        preco_filme = REPLACE( '100,60', ',', '.' ), 'vingadoresguerrainfinita.jpg', '149 minutos', 3, 4); 
UPDATE tbl_filme set preco_filme =  100.60 WHERE cod_filme = 4;


SELECT * FroM tbl_genero;

-- colocando os generos
INSERT INTO tbl_filme_genero (cod_filme, cod_genero) VALUES (1, 18);
INSERT INTO tbl_filme_genero (cod_filme, cod_genero) VALUES (1, 24);

INSERT INTO tbl_filme_genero (cod_filme, cod_genero) VALUES (2, 18);
INSERT INTO tbl_filme_genero (cod_filme, cod_genero) VALUES (2, 24);

-- colocando os diretores
INSERT INTO tbl_filme_diretor (cod_filme, cod_diretor) values (2, 1);

-- 
INSERT INTO tbl_filme_genero_categoria (cod_filme, cod_genero) VALUES (1, 25);
INSERT INTO tbl_filme_genero_categoria (cod_filme, cod_genero) VALUES (1, 23);
INSERT INTO tbl_filme_genero_categoria (cod_filme, cod_genero) VALUES (1, 24);

-- user 
desc tbl_nivel_usuario;
INSERT INTO tbl_nivel_usuario (nome_nivel, adm_conteudo, adm_fale_conosco, adm_produto, adm_usuairo) VALUES ('root', 1, 1, 1, 1);
INSERT INTO tbl_usuario (nome_usuario, email, senha, status, cod_nivel) VALUES ('admin', 'admin.127@gmail.com', '123', 1);

         
         
        