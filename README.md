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

## 🎴 Como Usar?

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

<br>

- Na raiz do projeto existe uma collection do Postman contendo os endpoints

```link
https://github.com/vitorMendonca95/objective-challenge-api/blob/master/objetive-challenge-api.postman_collection.json
```

<br>
