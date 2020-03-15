__Language :__ English

## Requirement Technology
- Symfony version ^5
- Git
- PHP version ^7
- composer

## User Story
As a User I would like to make a request to an API that will determine from a set of recipes what I can have for lunch today based on the contents of my fridge, so that I quickly decide what I’ll be having.


## Task
- A request to the `api/lunch` endpoint will receive a `JSON` response of the recipes based on the availability of ingredients 
- Only an ingredient is not past its `use_by` date (inclusive), will not receive recipes containing this ingredient.
- Only an ingredient is not past its `best_before` date (inclusive), but is still within its `use_by` date (inclusive), any recipe containing the oldest (less fresh) ingredient should placed at the bottom of the response object.


## Plan
- Created a new database
- Automatic CRUD API for data Recipe & Ingredient
- Create Endpoint `api/lunch`
- Unit testing


## Step by step
__Installansi__ 
- install symfony
- composer create-project symfony/skeleton rest_api


__add depedency api-platform & maker bundle__
- composer require api orm
- composer require maker server --dev
- composer require symfony/config
- composer require friendsofsymfony/rest-bundle
- composer require phpunit-bridge


__update DATABASE_URL on file .env__
- DATABASE_URL=mysql://root:@127.0.0.1:3306/db_lunch?serverVersion=5.7


__create CRUD entity Recipe & Ingredient__
- bin/console make:entity --api-resource

- bin/console make:entity Recipe
- add field (title|string|200)
- add field (ingredients|array)

- bin/console make:entity Ingredient
- add field (title|string|200)
- add field (best_before|date)
- add field (use_by|date)

__Create Schema__ 
- bin/console doctrine:database:create
- bin/console doctrine:schema:update --force


__execute preview websites__
- bin/console server:run
- open url http://localhost:8000/api
- you will see CRUD untuk entity Recipe & Ingredient 
- insert data into Recipe & Ingredient
- open url http://localhost:8000/api/lunch to get data lunch


__Create Routes on config/routes.yml__
api_lunch:
    path: /api/lunch
    # the controller value has the format 'controller_class::method_name'
    controller: App\Controller\RecipeController::list

__Create endpoint lunch__
- Create RecipeController
- Endpoint 'api/lunch' generated script for Sorting & filter methods on RecipeController.php and RecipeRepository.php

__Unit Testing ApiTestCase__
- file ./Test/Util/RecipeEndpointTest.php, ./Test/Util/IngredientEndpointTest.php, ./Test/Util/LunchEndpointTest.php
- Let's run our test now on console 
- bin/phpunit



