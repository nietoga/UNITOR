# Contibuting to UNITOR

# Disclaimer

While writing this guide we were inspired on multiple other standards developed by some other people: [Laravel: Best Practices](https://www.laravelbestpractices.com/), [PSR-2](https://www.php-fig.org/psr/psr-2/), [Airbnb JavaScript Guide](https://github.com/airbnb/javascript), [Spatie code-style](https://guidelines.spatie.be/code-style/laravel-php).

# Principles

## SOLID

### Single responsibility principle

A class should only have a single responsibility, that is, only changes to one part of the software’s specification should be able to affect the specification of the class.

### Open–closed principle

Software entities … should be open for extension, but closed for modification.

### Liskov substitution principle

Objects in a program should be replaceable with instances of their subtypes without altering the correctness of that program.

### Interface segregation principle

Many client-specific interfaces are better than one general-purpose interface.

### Dependency inversion principle

One should depend upon abstractions, not concretions.

## DRY

Every piece of knowledge must have a single, unambiguous, authoritative representation within a system.

# Conventions

Follow all Laravel developing conventions, read documentation and look for previously developed resources from which you can understand how things are done in UNITOR.

### Controllers

* Controller name MUST start with a noun (in singular form) followed by the word “Controller”.

    ```
    class ArticleController extends Controller
    {
    ```

### Models

* Model names MUST be in singular form with its first letter in uppercase

    ```
    class Flight extends Model
    {
    ```

* Create setters and getters for all the fields of a model.

* Create validations inside the models. Don't repeat yourself.

### Routes

* Try to name every single route.

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

* Use camelCase for named routes and kebab-case for public-facing urls in case there are more than 1 word.

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

### Database

* Use migrations. Do not change database directly.

* Do not edit migrations, once they've been added to the repository.

* Do not worry about migrations name length. Be specific with what you are doing. Preffer `2019_06_06_164210_add_price_to_products_table` instead of `2019_06_06_164210_update_products_table`.

* Table names must be in plural and lowercase.

* Pivot table names must be in singular model names in alphabetical order. `post_user` instead of `users_posts`.

# Styleguides

## PHP styleguide

* Omit the closing tag `?>` from files containing only PHP.

* Use an indent of 4 spaces. Do not use tabs.

* Use `true`, `false` and `null` in lowercase.

* `use` declarations come after the `namespace` declaration.

* Declare the visibility of all properties in classes, even if its the default.

* Leave a space after control structures: `if (condition)` instead of `if(condition)`.

* Leave a space between binary operators: `a + b` instead of `a+b`.

* Do not leave a space between a function's name and the first parentheses. Leave a space after each comma: `functionCall(param1, param2, param3)`.

* Names should be descriptive.

* Comment all non-trivial methods.

* Always use brackets after control statements. And keep the opening bracket on the same line as the intruction. 

    ```
    if (condition) {
        // whatever
    }
    ```

* Leave a trailing comma after multiline array definitions.

    ```
    $example = [
        'a' => 'A',
        'b' => 'B',
    ];
    ```

## Blade Styleguide

* Kepp HTML lines short.
* Leave a space after control structures: `@if (condition)` instead of `@if(condition)`.
* Leave spaces between brackets and its content: `{{ x }}` and `{!! x !!}`.

## Javascript Styleguide

* Use `let` instead of `var`.

# Improving quality

Additions and changes to this guide are welcomed. If you find something is missing, please ask for clarification and/or propose a solution to your problem with the goal of standarizing solutions to that problem if it ever appears again.