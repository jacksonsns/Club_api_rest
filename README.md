
# API Rest - Baseado em Laravel com Docker

## Requirements

Como é construído no framework Laravel, ele possui alguns requisitos de sistema.
Obviamente, todos esses requisitos são atendidos pelo Docker, portanto, é altamente recomendável que você use o Docker como seu ambiente de desenvolvimento Laravel local.
 
No entanto, se você não estiver usando o Docker, precisará verificar se o servidor atende aos seguintes requisitos:
- PHP >= 7.2.0
- MySql >= 5.7
- Composer
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

Você pode verificar todas as dependências relacionadas ao laravel [aqui](https://laravel.com/docs/8.x/installation#server-requirements).

## Instalação.

1. Clone o repositório e instalação.<br>
`git clone github.com/jacksonsns/Club_api_rest.git`<br>
`cd Club_api_rest`<br>
`cp .env.example .env`<br>
2. Suba os containers.<br>
`docker-compose up -d`
3. Instale os pacotes de dependência.<br>
`docker exec composer install`<br>
4. Gere a key do projeto e instale as migrates.<br>
`docker exec php artisan key:generate`<br>
`docker exec php artisan migrate`<br>


## Endpoints e rotas da API

    ```
    +-----------+----------------------------+-----------------+
    | Method    | URI                        | Name            |
    +-----------+----------------------------+-----------------+
    | GET       | /                          |                 |        
    +-----------+----------------------------+-----------------+
    | GET       | api/listar_usuarios        | usuarios.index  | 
    | POST      | api/login                  | usuario.login   |
    | POST      | api/registrar              | usuario.register|
    | GET       | api/apagar_usuario/{id}    | usuario.delete  |
    | GET       | api/recuperar_usuario/{id} | usuario.recover |
    | GET       | api/usuario/perfil         | usuario.profile |
    | GET       | api/usuario/sair           | usuario.logout  |
    | PUT       | api/usuarios/alterar/{id}  | usuario.update  |
    +-----------+----------------------------+-----------------+
    | GET       | api/clubes                 | clubes.index    |
    | POST      | api/associar/{id}          | clube.join      |
    | DELETE    | api/desassociar/{id}       | clube.leave     |
    | POST      | api/cadastrar_clube        | clube.register  |
    | PUT       | api/clubes/{id}            | clube.update    |
    | GET       | api/apagar_clube/{id}      | clube.delete    |
    | GET       | api/recuperar_clube/{id}   | clube.recover   |
    +-----------+----------------------------+-----------------+
    | GET       | api/fatura/{id}            | fatura.show     |
    | PUT       | api/fatura/pagar/{id}      | fatura.pay      |
    +-----------+----------------------------+-----------------+
    ```

