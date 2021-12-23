Hello devops,
As we know PDF document is basic necessity in PHP laravel development for invoice and other document generation. There would be need 2 things basically: dynamic data + html structure as expectation. So here one concept i want to introduce to you is html management. If our backbone is ready, it would be easy to put our dynamic stuff in that. 

System requirements:

Php : v7.2.5

Laravel : v6.20.26 

Dompdf Package : v0.9.0

Summernote Editor : v0.8.18

Steps:
1. Create Packages directory in your laravel project.
2. Add Htmlpdf package in packages directory.
3. Make autoload package related changes in composer.json file.
4. Add service provider class in config/app.php file.
5. composer dump-autoload.
6. publish package.
7. migrate database.
8. seed database.

Packagist: composer require aashiv/htmlpdf

Generate Pdf Design with Laravel Dompdf Package

Youtube: https://youtu.be/duTP6DJ7dWQ
