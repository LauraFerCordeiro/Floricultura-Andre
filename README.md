## WebService com integração de Banco de Dados e Sistema de Login
Possui o front-end e o back-end

#### Como funciona?
- É possível logar como cliente ou como administrador
- É possível criar uma conta nova. Caso crie sua conta, ela será definida automaticamente como cliente.
- O cliente pode vizualizar as plantas disponíveis e comprá-las (o sistema de compra é fictício). Cada planta também acompanha junto uma ferramenta própria dela.
- O administrador pode realizar um CRUD (cadastrar, visualizar, editar e deletar) de cada entidade (Plantas, Ferramentas e Clientes).
- Cada planta possui um estoque, portanto se o cliente comprar todas do estoque, a planta sumirá do Home, pois não estará mais disponível para compra
- Foi utilizado CRIPTOGRAFIA de senha, portanto ao cadastrar sua senha, o site criptografa automaticamente para o banco de dados, garantindo maior segurança
- Além disso foi utilizado o .htacess para controlar as páginas de acesso do usuário e sessões para delimitar quem pode acessar determinada página (adm ou cliente)

#### O que foi utilizado?
- Tecnologias: PHP, JavaScript, HTML, CSS e SCSS
- Servidor Web Apache (utilizei o XAMPP) para a interpretação dos Scripts
- Banco de Dados (utilizei o MySQL, via XAMPP, gerenciando pela interface do PhpMyAdmin)
- Commits via Git 

Obs* A floricultura André é totalmente fictícia e criada apenas para fins educacionais (o projeto foi feito em 2023)

#### Documentação:
XAMPP (Servidor web Apache): [Download](https://www.apachefriends.org/pt_br/index.html)

Após a instalação do XAMPP, é necessário executar o Apache Web Server e o MySQL:

<div align="center">
 
 ![imagem inicialização do XAMPP](https://github.com/user-attachments/assets/5a74e1b8-7ebf-46ee-977b-6e907831689a)

 ![imagem inicialização do Servidor Apache Web](https://github.com/user-attachments/assets/5cf4155e-c013-4258-ad89-71fafa4ca4e7)

 ![imagem Servidor rodando](https://github.com/user-attachments/assets/b37c0184-a2f0-41ba-94a4-261894dc38aa)

</div>

Repita o mesmo processo com o MySQL Database para executá-lo:

<div align="center">

  ![Imagem inicialização do MySQL Database](https://github.com/user-attachments/assets/9eac3703-dc3a-4d21-a17f-6ffb172dbcff)

  ![Imagem MySQL rodando](https://github.com/user-attachments/assets/17b97d09-192c-4687-8ebb-55850daf2b40)

</div>

Agora nosso Apache Web Server e nosso Banco de Dados já está rodando. Precisamos então colocar a nossa pasta de códigos PHP dentro da pasta htdocs do Xampp, para que ele possa executar localmente os scripts. 

##### Para Windows:

 *1º Vá até o diretório de instalação do XAMPP. Normalmente, a pasta “htdocs” está dentro da pasta XAMPP*

 *2º Cole a pasta do seu projeto dentro da pasta "htdocs"*

 *3º Acesse seu projeto digitando “http://localhost/NomeDoSeuProjeto” na barra de endereços do navegador*

##### Para Linux:

 *1º Localize a pasta "opt" do seu computador e a pasta "lampp" (normalmente fica dentro da "opt")*

 *2º Agora entre na pasta "htdocs" (normalmente fica dentro da pasta "lampp")*

 *3º Pronto, é aqui que você irá colocar todos seus projetos para serem executados localmente em seu servidor. Então cole a pasta do seu projeto aqui*

 *4º Acesse seu projeto digitando “http://localhost/NomeDoSeuProjeto” na barra de endereços do navegador*

