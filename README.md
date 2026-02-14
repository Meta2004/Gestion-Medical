<<<<<<< HEAD
Système de Réservation de Services Médicaux

Description :
Ce projet est une application web développée en Laravel permettant la gestion complète d’un centre médical. Il fournit une interface intuitive pour différents types d’utilisateurs (administrateurs, médecins et patients) et permet de gérer efficacement les services médicaux et les réservations.

Fonctionnalités principales :

Gestion des utilisateurs : ajout, modification et suppression des médecins et des patients.

Gestion des services médicaux : création, édition et suppression des services proposés par les médecins.

Réservations : les patients peuvent réserver des services, et les médecins peuvent consulter et gérer leurs rendez-vous.

Tableau de bord administrateur : statistiques en temps réel sur les utilisateurs, services et réservations, avec un accès rapide aux actions principales.

Sécurité : authentification et autorisation basées sur les rôles (admin, médecin, patient) pour protéger l’accès aux fonctionnalités.

Interface responsive : design moderne et adaptable à tous les types d’écrans grâce à Tailwind CSS et Blade components.

Technologies utilisées :

Backend : Laravel 10 (PHP 8)

Frontend : Blade, Tailwind CSS, FontAwesome

Base de données : MySQL

Authentification : Laravel Breeze avec gestion des rôles

Objectif du projet :
Fournir un système complet pour gérer un centre médical, réduire les erreurs de planification et améliorer l’expérience des patients et des médecins grâce à une interface claire et simple à utiliser.

Structure du projet :

app/Http/Controllers : contrôle les utilisateurs, services et réservations

resources/views : templates Blade pour chaque tableau de bord et page de gestion

routes/web.php : routes protégées par middleware selon le rôle de l’utilisateur
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> efa015d (Gestion-Medical)
