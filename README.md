Symfony Rest Api
=====================

Goal: 

 - The goal is to create an API that will allow to create an article, answer to an article, rate an article (between 0 and 5 ==> 0, 1, 2, 3, 4, 5)
 - This API should also include to retrieve an article and all its answers
 - Write some unit tests.

Bonus 1:

 - Write a front page that will allow us to write an article (keep it simple)

Bonus 2:

 - Write a command that will send an email to the writer of an article if he has notifications from more than 24 hours.


The app
=====================

## Installation

http://54.171.144.169/

### Backend

```sh
$ composer install
$ php app/console doctrine:schema:update
$ php app/console doctrine:fixtures:load
```
### Frontend

```sh
$ npm install
$ bower install
$ gulp build
```

### Start server

```sh
$ php app/console server:run
```