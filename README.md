## 🖥 Tecnologias/Pacotes

#### `Back-end`

- [PHPUnit](https://github.com/sebastianbergmann/phpunit#phpunit)
- [Laravel](https://laravel.com/docs/10.x)
- [LaravelSail](https://laravel.com/docs/10.x/sail)

<br>

## 📁 Dependências

- Docker version 24.0.5
- Docker Compose version v2.20.2

<br>

## 📣 Informaçoes importantes
- O user e password do banco de dados MySQL, serão definidos pelos valores das variáveis `DB_USERNAME` e `DB_PASSWORD` do arquivo `.env` da aplicação durante o build. Será criado também o usuário root contendo a mesma senha.
- As portas dos serviços de aplicação e de banco de dados foram mantidas em seu padrão (portas 80 e 3306). Caso seja necessário, as portas poderão ser alteradas no arquivo `docker-compose.yml`.

## 🎴 Como Usar?
- Criar o arquivo .env
- Dentro da raiz do projeto execute os seguintes comandos

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

```bash
./vendor/bin/sail up -d
```


```bash
./vendor/bin/sail artisan migrate
```

<br>

- No mesmo diretório, existe uma collection do Postman contendo os endpoints

```link
https://github.com/vitorMendonca95/objective-challenge-api/blob/master/objetive-challenge-api.postman_collection.json
```

<br>
