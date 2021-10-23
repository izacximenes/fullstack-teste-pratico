# Teste fullstack PHP e VUEJS

## Como rodar o projeto PHP
### Requisitos
- PHP 7.3 ou maior
- MYSQL
  
Configure o .env com as informações de conexão do banco MYSQL. 
```
DB_CONNECTION=mysql
DB_HOST=test-php-db
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=root
```

Após a configuração rode o comando:
```bash
php artisan migrate
```
Para roda o servidor use o comando:
```bash
php artisan serve
```

## Como rodar o projeto VUEJS
### Requisitos
- NODEJS
  
Instale as dependências:
```bash
npm i
```
Para roda o servidor use o comando:
```bash
npm run serve
```

