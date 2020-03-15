__Language :__ English | [Bahasa Indonesia](README_ID.md)



## User Story
As a User I would like to make a request to an API that will determine from a set of recipes what I can have for lunch today based on the contents of my fridge, so that I quickly decide what I’ll be having.


Feature
- A request to the `api/lunch` endpoint will receive a `JSON` response of the recipes based on the availability of ingredients 
- Only an ingredient is not past its `use-by` date (inclusive), will not receive recipes containing this ingredient.
- Only an ingredient is not past its `best-before` date (inclusive), but is still within its `use-by` date (inclusive), any recipe containing the oldest (less fresh) ingredient should placed at the bottom of the response object.


Restful API
-Created a new database
-Automatic CRUD for data Recipe & Ingredient
-Filtering and Ordering
-Installed PHPUnit


step by step
-install symfony
composer create-project symfony/skeleton rest_api

-add depedency api-platform & maker bundle
composer require api orm
composer require maker server --dev
composer require symfony/config
composer require friendsofsymfony/rest-bundle
composer require phpunit-bridge


-update DATABASE_URL on file .env
DATABASE_URL=mysql://root:@127.0.0.1:3306/db_lunch?serverVersion=5.7


-create entity Recipe & Ingredient
bin/console make:entity --api-resource

bin/console make:entity Recipe
add field (title|string|200)
add field (ingredients|array)

bin/console make:entity Ingredient
add field (title|string|200)
add field (best_before|date)
add field (use_by|date)

Create Schema 
bin/console doctrine:database:create
bin/console doctrine:schema:update --force


-execute preview websites
bin/console server:run
open url http://localhost:8000/api
you will see CRUD untuk entity Recipe & Ingredient 
insert data into Recipe & Ingredient

Create Routes on config/routes.yml
api_lunch:
    path: /api/lunch
    # the controller value has the format 'controller_class::method_name'
    controller: App\Controller\RecipeController::list

Create RecipeController
Sorting & filter methods on RecipeController




Requirement Technology:
-Symfony version ^5
-Git
-PHP version ^7


