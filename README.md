BileMo API (OpenClassrooms project)

With this API, you can :
- consult the list of products
- consult details of one product in particular
- consult the list of clients
- consult details about one client in particular
- consult the list of users registered linked to one client
- consult details about one user linked to on client
- add a new user linked to a client
- modify a user linked to a client
- delete a user linked to a client

Everyone can see the list and details of products and clients
But only clients which are logged can acces the list of their users, add, modify, delete.

INSTALLATION
clone or download the project :
cd project-bilemo/
git clone https://github.com/JeromeLacquemant/projet-7.git

Update the .env with your database credentials.

Use Composer to install dependecies :
composer install

Create the database :
php bin/console do:da:cr

Create associated tables :
php bin/console do:sc:up --force

Use the fixtures :
php bin/console do:fi:lo --append

Lauch the server :
php bin/console se:ru (or symfony serve)


DOCUMENTATION
Available here : http://localhost:8000/doc

DEVELOPPED WITH :
Php 8.0.8
Symfony 5.2.1
VisualStudioCode - 2019.1.1
Insomnia Version v2021.4.1

AUTHOR
Jérôme LACQUEMANT 