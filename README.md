# P6_OC
Project to create a site about snowboard tricks - Project given by OpenClassRoom For studies

<a href="https://codeclimate.com/github/AureleSarrail/P6_OC/maintainability"><img src="https://api.codeclimate.com/v1/badges/c89822e8ecac47110a8a/maintainability" /></a>

<h1>How to Install</h1>

To Install SnowTricks, you will have to clone this Repository or download the code directly via this github.

First of all, You will have to configure your .env file.
You will have to put here your DB info.

You will have to create the database with the migrations files with the command :
php bin\console doctrine:migrations:migrate.

You will have to populate the database.
I made some fixtures in order to do that.
You can use the command :
php bin\console doctrine:fixtures:load


