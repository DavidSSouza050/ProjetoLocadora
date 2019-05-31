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

SELECT filme.titulo_filme as filme_titulo,
                    filme.cod_filme as filme,
                    categoria.cod_categoria as cod_categoria
                    FROM tbl_filme_genero_categoria as filme_categoria inner JOIN tbl_categoria as categoria
                    ON filme_categoria.cod_categoria = categoria.cod_categoria left join tbl_filme as filme
                    ON filme_categoria.cod_filme =  filme.cod_filme
                    WHERE categoria.cod_categoria = 1;
                    
                    select * from tbl_categoria;
   SELECT filme.titulo_filme as filme_titulo,
                    filme.cod_filme as filme,
                    categoria.cod_categoria as cod_categoria
                    FROM tbl_filme as filme right JOIN tbl_filme_genero_categoria as filme_categoria
                    ON filme.cod_filme = filme_categoria.cod_filme inner JOIN tbl_categoria as categoria
                    ON filme_categoria.cod_categoria = categoria.cod_categoria 
                    WHERE categoria.cod_categoria = 1;
SELECT  filme.cod_filme,
		filme.titulo_filme,
		filme.status_produto,
		filme.preco_filme,
        group_concat(genero.genero SEPARATOR '/'),
        distribuidora.distribuidora
		FROM tbl_filme as filme INNER JOIN tbl_filme_genero as filme_genero
        ON	filme.cod_filme = filme_genero.cod_filme INNER JOIN tbl_genero AS genero
        ON 	filme_genero.cod_genero = genero.cod_genero INNER JOIN tbl_ditribuidora as distribuidora
        ON filme.cod_distribuidora = distribuidora.cod_distribuidora GROUP BY cod_filme;


UPDATE tbl_filme set status_produto = 0 WHERE cod_filme > 0;


SELECT filme.cod_filme,
		filme.titulo_filme, 
        filme.descricao, 
        filme.preco_filme, 
        filme.imagem_filme, 
        filme.duracao, 
		classificacao.cod_classificacao, 
        classificacao.classificacao, 
        distribuidora.cod_distribuidora, 
        distribuidora.distribuidora
		FROM tbl_filme as filme INNER JOIN tbl_classificacao as classificacao
		ON filme.cod_classificacao = classificacao.cod_classificacao INNER JOIN tbl_ditribuidora as distribuidora
		ON filme.cod_distribuidora = distribuidora.cod_distribuidora
		WHERE cod_filme = 2;

SELECT filme.cod_distribuidora,
		distribuidora.cod_distribuidora
        FROM tbl_filme as filme right JOIN tbl_ditribuidora as distribuidora
        ON filme.cod_distribuidora = distribuidora.cod_distribuidora WHERE distribuidora.cod_distribuidora = 3;

SELECT cod_distribuidora from tbl_filme;




SELECT * FROM tbl_filme WHERE cod_filme = 1;

SELECT diretor.cod_diretor,
                diretor.diretor,
                filme.titulo_filme,
                filme.cod_filme
                FROM tbl_diretor AS diretor INNER JOIN tbl_filme_diretor as filme_diretor
                ON diretor.cod_diretor = filme_diretor.cod_diretor INNER JOIN tbl_filme AS filme
                ON filme.cod_filme = filme_diretor.cod_filme WHERE diretor.cod_diretor = 2;


SELECT * FROM tbl_filme_diretor;



select * from tbl_categoria;
DESC tbl_categoria;
INSERT INTO tbl_categoria VALUES (1, 'DVD', 0);
INSERT INTO tbl_categoria VALUES (2, 'VHS', 0);

select * from tbl_genero_categoria;
DESC tbl_genero_categoria;
INSERT INTO tbl_genero_categoria VALUES (1, 1, 1);
INSERT INTO tbl_genero_categoria VALUES (2, 23, 1);
INSERT INTO tbl_genero_categoria VALUES (3, 25, 1);
INSERT INTO tbl_genero_categoria VALUES (4, 24, 1);
INSERT INTO tbl_genero_categoria VALUES (5, 18, 1);

INSERT INTO tbl_genero_categoria VALUES (6, 25, 2);
INSERT INTO tbl_genero_categoria VALUES (7, 24, 2);
INSERT INTO tbl_genero_categoria VALUES (8, 18, 2);

UPDATE tbl_genero_categoria set cod_genero = 1 WHERE cod_genero_categoria = 1;

DROP TABLE tbl_filme_genero;

CREATE TABLE tbl_filme_genero_categoria(
	cod_relacao_filme_genero_categoria INT AUTO_INCREMENT PRIMARY KEY,
    cod_filme INT NOT NULL,
    cod_genero INT NOT NULL,
    cod_categoria INT,
     FOREIGN key (cod_filme) REFERENCES tbl_filme (cod_filme),
    FOREIGN key (cod_genero) REFERENCES tbl_genero (cod_genero),
     FOREIGN key (cod_categoria) REFERENCES tbl_categoria (cod_categoria)
);

DELETE FROM tbl_filme_genero where cod_filme > 0;
         
         
         
        