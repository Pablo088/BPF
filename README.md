<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Resumen del programa

El software permite ver las diferentes paradas de colectivo, las distintas rutas que siguen los mismos, ademas de una experiencia personalizada para el usuario, estas caracteristicas se muestran en un mapa de la localidad de Gualeguaychu Entre Rios 

## Guia de instalación

1. Podes descargar el proyecto tocando el boton "code" y luego presionando "download", o podes hacer un git clone (si tienes git instalado en tu pc en la consola de comandos introducís: git clone https://github.com/Pablo088/BPF.git).
2. Copia el archivo ".env.example". Ahora vas a tener que renombrar esa copia de ".env.example" como ".env".
3. Abre Laragon y asegurate de que inicie todos sus procesos.
4. En la consola de comandos de Laragon (boton Terminal), ingresa el comando "cd BPF" para dirigirte al directorio del proyecto.
5. Introducí el comando "composer install".
6. Luego tenés que introducir el comando "php artisan key:generate --ansi".
7. Luego dirigite a "base de datos". Presiona donde dice "abrir"
8. Ahora tenés que correr las migraciones con "php artisan migrate --seed" (si no existe la base de datos tienes que escribir "yes" o solo "y" para que cree la base de datos).
9. Corre el comando npm run dev (consola de Laragon).
10. Duplica la consola de comandos que estas usando (podes hacerlo haciendo click derecho en "cmder", llendo a "Active console", luego a "Restart or Duplicate" y "duplicate root" o puedes darle al simbolo de + que se encuentra en la parte de abajo de la consola de Laragon, donde dice "Startup directory for new process:" busca la direccion del proyecto y dale a "Start").
11. En esa consola de comandos que duplicaste, corre el comando "php artisan serve"
12. En el heidi sql, dirigite a "archivo", luego a "cargar archivo sql" y selecciona el archivo "BPF" (se encuentra en la carpeta raiz del proyecto, debajo de la carpeta vendor).
13. Abre otra ventana en la consola de Laragon en la direccion del proyecto (siguendo los mismos pasos nombrados en el paso 10) e ingresa el siguente comando "ngrok http 8000" (en caso de que esto falle puedes utilizar la consola de ngrok que se encuentra en la carpeta raiz del proyecto, si continua fallando ve a la siguente direccion https://dashboard.ngrok.com/get-started/setup/windows y ejecuta el comando "ngrok config add-authtoken" junto con el token proporcionado).
14. Por último ingresa al link terminado en ".ngrok-free.app" que se encuentra en la linea Forwarding y dale al boton "visit site" que se encuentra en la pagina.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
