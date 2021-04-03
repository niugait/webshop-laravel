# Webshop

### Requisitos
- Docker
- Composer
- NPM

---

### Configurando Ambiente

1. Instale as dependências do Laravel.
```shell
composer install
```
2. Instale e compile as dependências do projeto.
```shell
npm install
npm run prod
```
3. Configure as variáveis de ambiente
```shell
cp .env.example .env
```

4. Execute as instâncias do projeto utilizando o Laravel Sail.
```shell
./vendor/bin/sail up -d
```

5. Execute as migrations do banco de dados.
```shell
./vendor/bin/sail artisan migrate
```

5.1. Gere a chave da aplicação.
```shell
./vendor/bin/sail artisan key:generate
```

5.2. Gere o primeiro usuário administrativo.
```shell
./vendor/bin/sail artisan admin:create
```
---
Acesse pelo http://localhost:80
