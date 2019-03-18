# SF4-W-basic

composer require doctrine/doctrine-fixtures-bundle --dev
composer require fzaninotto/faker --dev

php -S 127.0.0.1:8000 -t public

https://github.com/webinarium/symfony-lazysec/tree/master/src/Entity
https://sharemycode.fr/1ef
https://sharemycode.fr/dyk
https://sharemycode.fr/sd3

===SF4 BDD===

create database <name>;
grant all on <name>.* to '<name>' identified by '<pwd>';

composer require doctrine
composer require --dev doctrine/doctrine-fixtures-bundle
composer require fzaninotto/faker --dev
====Create DB====
php ./bin/console doctrine:database:create
php ./bin/console doctrine:schema:create
====Update DB====
php ./bin/console doctrine:schema:update --force
====Rollback DB====
php ./bin/console doctrine:migration:migrate prev

===SF4 front===
curl --silent --location https://dl.yarnpkg.com/rpm/yarn.repo | sudo tee /etc/yum.repos.d/yarn.repo
yum install yarn
composer require twig asset encore form
yarn install

/*edit*/ ./webpack-config-js

yarn add sass-loader node-sass jquery popper.js bootstrap --dev

/*edit*/ ./assets/js/app.js

 /*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
 
 // any CSS you require will output into a single css file (app.css in this case)
 //require('../css/app.scss');
 
 // Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
 var $ = require('jquery');
 require('bootstrap');

 console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

yarn run encore dev --watch


wifi Merci3wa!