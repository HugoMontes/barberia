<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Instalación

Pasos para realizar la instalación:

1. Clonar el proyecto.
2. Instalar dependencias php.

```bash
> composer install
```

3. Instalar depencias node.

```bash
> npm install
```

4. Ejecutar archivos de migracion.

```bash
> php artisan migrate
```

5. Ejecutar los seeders para añadir registros.

```bash
> php artisan db:seed
```

6. Levantar el servicio de laravel.

```bash
> php artisan serve
```

7. Levantar el servicio Vite.

```bash
> npm run dev
```

8. Verificar ingresando a [http://localhost:8000/](http://localhost:8000/).

9. Ingresar al modo administrador http://localhost:8000/login con las siguientes credenciales:

-   usuario: admin@example.com
-   password: 123456
