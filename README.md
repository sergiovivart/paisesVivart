creado por Sergio Vivas - Github @https://github.com/sergiovivart - 6/12/2022
Antes de ejecutar la aplicacion asegurate de hacer lo siguiente

Instalar las dependencias necesarias via composer
# composer install

crear la base de datos MySql
# app_paises

Edita las credenciales para utilizar la base de datos
# /.env

#acer la migracion
# php bin/console make:migration

#jecutamos la migracion
# php bin/console doctrine:migrations:migrate

#anzamos el servidor
# symfony server:start