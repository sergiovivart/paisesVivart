# powerShell
# Antes de ejecutar la aplicacion asegurate de hacer lo siguiente.
# Entra en la carpeta del projecto con la terminal.

# Instalar las dependencias necesarias via composer con el comando.
composer install

# Edita las credenciales para usar tu base de dato MySQL en 
/.env

# Hacer las migraciones desde la consolo para hacer la base de datos


# Creamos la migracion
php bin/console make:migration

# Ejecutmaos la migracion
php bin/console doctrine:migrations:migrate

# lanzamos el servidor
symfony server:start