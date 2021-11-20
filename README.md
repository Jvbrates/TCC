
# Convenções  de Código(Anotações)

## Dados no banco
### Turnos:
0. Manhã
1. Tarde
2. Noite 
3. Integral Matutino
4. Integral Vespertino
5. Flexível 

### Modalidades:
0. Presencial 
1. Ead

### Tipos Duração:
0. Horas
1. Semestres
2. Anos

### Tipos Curso:

1. Profissionalizante 
2. Técnico
3. Graduação - Técnologo
4. Graduação - Bacharel
5. Graduação - Licenciatura
6. Pós-graduação - Lato sensu
7. Pós-graduação - Stricto sensu



Isset: Verifica se a variável é definida.

Se a variável for destruída com unset(), ela não existirá mais. isset() retornará false se for usada em uma variável com o valor null. Lembrando que no PHP um byte null ("\0") é diferente da constante null.

Se múltiplos parâmetros são fornecidos, então isset() retornará true somente se todos os parâmetros são definidos. A avaliação vai da esquerda para direita e pára logo que encontra uma variável não definida. 



_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-



Empty : Determina se uma variável é considerada vazia. Uma variável é considerada vazia se não existir ou seu valor é igual false. A função empty() não gera um aviso se a variável não existir. 




homecontroller -- mecanismo de busca padrão
logincontroller -- controller de login
usuariocontroller -- editar dados usuario, favoritar cursos, visualizar favoritos
moderador controles
user1 - favoritar cursos, fazer buscar, alterar dados do perfil, recuperar senha
user2 - favoritar cursos, fazer buscar, alterar dados do perfil, recuperar senha, gerenciar cursos instituições
user3 - favoritar cursos, fazer buscar, alterar dados do perfil, recuperar senha, gerenciar cursos instituições, gerenciar moderadores, gerenciar usuarios



template0.php >=> usuario comum logado


template9.php >=> usuario nao logado
template1.php >=> gerenciador logado
template2.php >=> administrador logado 
        
TODO avaliar Criação de uma model só para requisições