# Antes de ejecutar la aplicacion asegurate de hacer lo siguiente
* Abrimos la carpeta del projecto en un  terminal
# Instalar las dependencias necesarias via composer.
composer install

# Edita las credenciales para usar tu base de datos ubicadas en
/.env

# Hacemos una migracion
php bin/console make:migration

# Ejecutamos la migracion
php bin/console doctrine:migrations:migrate

# Lanzamos el servidor
symfony server:start