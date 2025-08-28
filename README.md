# PruebaTeconologiaSinergia

## Descripción técnica
Aplicación web desarrollada en Laravel (PHP) para la gestión de entidades y procesos administrativos. El proyecto implementa arquitectura MVC, migraciones, seeders, controladores y modelos, integrando funcionalidades de autenticación, autorización y manejo de base de datos relacional.

## Comandos útiles

### Borrar caché de configuración y rutas
```powershell
php artisan config:cache; php artisan route:cache; php artisan cache:clear
```

### Ejecutar migraciones
```powershell
php artisan migrate
```

### Ejecutar seeders
```powershell
php artisan db:seed
```

### Ejecutar migraciones y seeders juntos
```powershell
php artisan migrate --seed
```

## Estructura principal
- `app/`: Modelos, controladores y middleware
- `database/`: Migraciones y seeders
- `routes/`: Definición de rutas web y API
- `resources/`: Vistas y archivos estáticos

## Requisitos
- PHP >= 8.x
- Composer
- Base de datos MySQL o compatible

## Instalación rápida
1. Clonar el repositorio
2. Instalar dependencias con `composer install`
3. Configurar `.env`
4. Ejecutar migraciones y seeders

## Autor
Norman13xx5
