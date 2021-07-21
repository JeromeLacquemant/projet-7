# BileMo API (OpenClassrooms project)

With this API, you can (as a client):
- consult the list of products
- consult details of one product in particular
- consult the list of clients
- consult details about one client in particular
- consult the list of users registered linked to one client
- consult details about one user linked to on client
- add a new user linked to a client
- modify a user linked to a client
- delete a user linked to a client

## INSTALLATION
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

## DOCUMENTATION
Available here : http://localhost:8000/doc


## ACCESS AS A CLIENT
To access the Api, you need to be authenticated as a client
To test it this is a fixture you can used :
{
	"username": "client_0@gmail.com",
	"password": "12345"
}

### DEVELOPPED WITH :
Php - 8.0.8
Symfony - 5.2.1
VisualStudioCode - 2019.1.1
Insomnia Version - 2021.4.1

### AUTHOR
Jérôme LACQUEMANT 


