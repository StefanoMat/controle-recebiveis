# controle-recebiveis
Sistema de cadastro de dívidas para Receiv


## Como iniciar?
Há uma estrutura da aplicaçõe do client , com seu composer no root, e o back-end na pasta app/. Por isso dê o comando install nas duas pastas:
```
composer install
cd app && composer install
```
## Váriaveis de ambiente 
configure o arquivo .ENV do root para apontar o host back-end (default: localhost:3000) e .ENV da pasta app/ para dados de acesso do banco de dados

## Crie o banco de dados
Crie o banco de dados a partir do arquivo base.sql no root

## Inicie o servidor
###  Para o back-end
porta default para a aplicação backend:
```
php -S localhost:3000
```
### Para o client
```
php -S localhost:3030
```

### Visualização de template
https://www.dropbox.com/s/o45w46khun39vdy/index.png?dl=0

## Testes
Rode os testes na pasta app/
```
cd app && ./vendor/bin/phpunit  
```
