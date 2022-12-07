Creado por Sergio Vivas - Github @https://github.com/sergiovivart - 6/12/2022 con *Symfony 5.4*
Antes de ejecutar la aplicacion asegurate de hacer lo siguiente.

crear la base de datos en MySql
> app_paises

Edita las credenciales para utilizar la base de datos
> /.env

Instalar las dependencias necesarias via composer
> composer install

Hacer la migracion
> php bin/console make:migration

Ejecutar la migracion
> php bin/console doctrine:migrations:migrate

Lanzamos el servidor
> symfony server:start
