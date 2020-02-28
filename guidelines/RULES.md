# Programming Rules

# SOLID

## Single responsibility principle

A class should only have a single responsibility, that is, only changes to one part of the software’s specification should be able to affect the specification of the class.

## Open–closed principle

Software entities … should be open for extension, but closed for modification.

## Liskov substitution principle

Objects in a program should be replaceable with instances of their subtypes without altering the correctness of that program.

## Interface segregation principle

Many client-specific interfaces are better than one general-purpose interface.

## Dependency inversion principle

One should depend upon abstractions, not concretions.

# DRY

Every piece of knowledge must have a single, unambiguous, authoritative representation within a system.

# Conventions

## Controllers

* Controller name MUST start with a noun (in singular form) followed by the word “Controller”.

    ```
    class ArticleController extends Controller
    {
    ```

## Views

* Every view should extend layouts/master.
* Every view must be a blade file.

## Models

* Model names MUST be in singular form with its first letter in uppercase

    ```
    class Flight extends Model
    {
    ```

* Create setters and getters for all the fields of a model.

* Create validations inside the models instead of doing them manually inside controllers.

## Routes

* Always handle requests with a controller.

    Preffer this

    ```
    Route::get('/', 'RootController@index);
    ```

    Over this

    ```
    Route::get('/', function () {
        return view('welcome');
    });
    ```

* Use camelCase for named routes and kebab-case for public-facing urls.

    ```
    Route::get('open-source', 'OpenSourceController@index')->name('openSource');
    ```

* Have a clear hierarchy in routes.

    ```
    /products
    /products/{id}
    /products/delete/{id}
    /products/create
    ```

## Database

* Use migrations. Do not change database directly.

* Do not edit migrations, once they've been added to the repository.

* Do not worry about migrations name length. Be specific with what you are doing. Preffer `2019_06_06_164210_add_price_to_products_table` instead of `2019_06_06_164210_update_products_table`.

* Table names must be in plural and lowercase.

* Pivot table names must be in singular model names in alphabetical order. `post_user` instead of `users_posts`.
