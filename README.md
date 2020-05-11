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

## Primeira tela da aplicação do client
![Image description](https://previews.dropbox.com/p/thumb/AAyLgysB6HQiXT2DHg57dmR48jn-OH6DQCOgb6Ia_Pb0JvDnFfiJyEQLnI1WFVT_nEVf050iyzMdzOvwx87Wj0JHfFLwnq1woxih8HjZ-WCFS88GtiG_zaPWuf2c1lyDOowtF973nF0UorkO4bt7Tqs7I2mX3XC9sXBUJb-GmrCfJ4QXLthzo8tlTIZVehC48GT0p-230rPECRUqV7GsG0chaksp9FINphkj9shWAnsuXRSuHmJJrN7P4LVvqPSwtfsVAG96C_-97fKgydBiGz0-LK6YkLXYk1dj6ExTSxY_qe1r-RGg701xhFiUcUmbMiiAtFzD7KkwcCRYp7R14e3GxjEFz3m7vav7xQxrbH_BhdpNvManYmhBzkeOaB4kLBAJkXNgPEpzGLvr2rsRrgodqoaQtA8LSibcQrPoPYLX0w/p.png?fv_content=true&size_mode=5)

## Testes
Rode os testes na pasta app/
```
cd app && ./vendor/bin/phpunit  
```
