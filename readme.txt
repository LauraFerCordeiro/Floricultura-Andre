WebService com integração de Banco de Dados e Sistema de Login
Possui o front-end e o back-end

Como funciona?
- É possível logar como cliente ou como administrador. Também é possível criar sua conta. Caso crie sua conta, ela será automáticamente como cliente, então você poderá vizualizar as plantas disponíveis e comprá-las (o sistema de compra é fictício). Cada planta também acompanha junto uma ferramenta própria dela.
- O administrador pode realizar um CRUD (cadastrar, visualizar, editar e deletar) de cada entidade (Plantas, Ferramentas e Clientes).
- Cada planta possui um estoque, portanto se o cliente comprar todas do estoque, a planta sumirá do Home, pois não estará mais disponível para compra
- Foi utilizado CRIPTOGRAFIA de senha, portanto ao cadastrar sua senha, o site criptografa automaticamente para o banco de dados, garantindo maior segurança
- Além disso foi utilizado o .htacess para controlar as páginas de acesso do usuário e sessões para delimitar quem pode acessar determinada página (adm ou cliente)

O que foi utilizado?
- Tecnologias: PHP, JavaScript, HTML, CSS e SCSS
- Servidor Web Apache (utilizei o XAMPP) para a interpretação dos Scripts
- Banco de Dados (utilizei o MySQL, via XAMPP, gerenciando pela interface do PhpMyAdmin)
- Commits via Git 

Obs* A floricultura André é totalmente fictícia e criada apenas para fins educacionais (o projeto foi feito em 2023)
