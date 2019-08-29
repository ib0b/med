# Med App
Medical Laravel-Vue App

## How to Deploy or run locally.
Install Apache, PHP 7,composer,latest stable node and npm and MariadDB
edit .env with your database and create MariaDB database if you need to.

Run the following commands: [from /var/www/html or htdocs dir]


```sh
git clone https://github.com/updatesvc/med.git
cd med
```
For windows run
```
git pull origin master
composer install --no-interaction --prefer-dist --optimize-autoloader
php artisan migrate --force
php artisan migrate:refresh --seed --force
php artisan cache:clear
php artisan auth:clear-resets
php artisan route:clear
php artisan route:cache
php artisan config:clear
php artisan config:cache
npm install
npm run production
```

For linux or if you have gitbash run
```
npm run initialize-linux
```
- might get some route:cache errors [can ignore]

## Virtual Hosts
setup vhosts.conf for local development
```
<VirtualHost [test domain also add to hosts file if developing locally].test:80>
    DocumentRoot "[Med directory goes here]/public"
    DirectoryIndex index.php      
    <Directory "[Med directory goes here]/public">
        Options All
        AllowOverride All
        Order Allow,Deny
        Allow from all
    </Directory>
</VirtualHost>
```
## User story
Patient walks in hospital.
Goes to reception first [always].
- #### reception
Receptionist must be logged in.
Reception checks if they are a new or existing patient. [adds them if new].
Reception then adds the patient to repective queue from drop down.

Patient sits down and waits to be called to the department they were queued in.

- ####  practitioner/departmnet
Practitioner logs in.
Checks if there is any patient in queue. 
Clicks on next Patient.
Intercom\PA sytem announces "Mary please report to [department]" .
Patients arrives at department.
Doctors enters notes from consultation, and submits.
Doctor then has option to end patient visit(discharge) or refer to another department.

## Implementation Summary

The following accounts are seeded by default.

| email | password |
| ------ | ------ |
| reception@med.com | reception |
| treatment@med.com | treatment|
| [department]@med.com | [department] |

Where departments are the respective departments in small case.

It implements a queue system [a queue table] where each department views its respective queue and can call a patient and pop them form the queue/stack. Except for the Reception department.

Department routes are guarded by authentication middleware.

## Tests
run php unit below
```
php vendor/phpunit/phpunit/phpunit

```
Due to time contraints I implemented one test for the login directory. Checking 200 OK status. For login route




## Conlcusion
As much as I would like to add on this project, the time was not quite sufficient.
Missing a few things.
- CI/CD actions and triggers
- Deployment Scripts, faced a few challenges in getting docker to work. Dropped it due to time constrictions

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)



