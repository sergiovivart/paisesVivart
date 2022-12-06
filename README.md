Creado por Sergio Vivas - Github @https://github.com/sergiovivart - 6/12/2022 con *Symfony 5.4*
Antes de ejecutar la aplicacion asegurate de hacer lo siguiente.

Instalar las dependencias necesarias via composer
# composer install

crear la base de datos en MySql
# app_paises

Edita las credenciales para utilizar la base de datos
# /.env

Hacer la migracion
# php bin/console make:migration

Ejecutar la migracion
# php bin/console doctrine:migrations:migrate

Lanzamos el servidor
# symfony server:start