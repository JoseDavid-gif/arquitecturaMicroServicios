Lumen Reviews API

Microservicio para gestionar reseñas (reviews).

Instrucciones rápidas:

- Instalar dependencias:

```bash
composer install
```

- Copiar el entorno y ajustar `DB_*` en `.env`:

```bash
cp .env.example .env
```

- Ejecutar migraciones:

```bash
php artisan migrate
```

- Levantar servidor (para pruebas locales):

```bash
php -S localhost:8003 -t public
```

