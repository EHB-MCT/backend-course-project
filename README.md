# backend-course-project

# Running the code

## Required
It's required to have <a href="https://nodejs.org/en/">node</a> and <a href="https://getcomposer.org/">Composer</a> installed for installing the correct packages.

## Setup
<ol>

<li>
    Install the necessary npm packages.
</li>

    npm install

<li>
    Install the necessary npm packages.
</li>

    composer install

<li>
    Copying the env example to create an env base file.
</li>

    cp .env.example .env

<li>
    Generating a project key in your env file.
</li>

    php artisan key:generate

<li>
    update your database credentials in the .env file to use your database.</br>
    This can be for your local running database.
</li>

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=feedbacktool
    DB_USERNAME=root
    DB_PASSWORD=

<li>
    After this migrate your database will be ready to use.</br>
    If you get errors or your database isn't updated if you refresh check your credentials.
</li>

    php artisan migrate

<li>
    If you want demo data to test with.
</li>

    php artisan db:seed

<li>
    If you want to refresh and seed at once
</li>

    php artisan migrate:fresh --seed

</ol>

## Run

To run the site use:

    php artisan serve

To keep the JavaScript up-to-date run:

    npm run dev


# The Sources I used while building this project

# <a href="https://laravel.com/docs/">Laravel</a>

## Breeze
<ul>
    <li>
        <a href="https://laravel.com/docs/9.x/starter-kits#laravel-breeze">/breeze</a></br>
        Setting up Breeze
    </li>

</ul>

## Seeding
<ul>
    <li>
        <a href="https://laravel.com/docs/9.x/seeding">/seeding</a></br>
        Seeding my database
    </li>
    <li>
        <a href="https://laravel.com/docs/9.x/eloquent">/eloquent</a></br>
        Seeding with models and factories
    </li>
    <li>
        <a href="https://laravel.com/docs/9.x/eloquent-relationships">eloquent relations</a></br>
        Eloquent model relations
    </li>
</ul>

## Css and Js
<ul>
    <li>
        <a href="https://laravel.com/docs/9.x/vite#loading-your-scripts-and-styles">/vite</a></br>
        Using my css and js resources 
    </li>
</ul></br>

# <a href="https://stackoverflow.com/questions">Stackoverflow</a>
## Errors
<ul>
    <li>
        <a href="https://stackoverflow.com/questions/22615926">/migration-cannot-add-foreign-key-constraint</a></br>
        Solved migration error 1215
    </li>
    <li>
        <a href="https://stackoverflow.com/questions/17648179">/sqlstate23000-integrity-constraint-violation-1452</a></br>
        Solved factory seeding error 1452
    </li>
    <li>
        <a href="https://stackoverflow.com/questions/29915514">/how-to-generate-env-file-for-laravel</a></br>
        Create an .env file and a project key
    </li>
    <li>
        <a href="https://stackoverflow.com/questions/51116029">/how-to-check-current-url-inside-if-statement-in-laravel-5-6</a></br>
        Change header title based on what page you are
    </li>
    <li>
        <a href="https://stackoverflow.com/questions/32667319">/getting-records-with-multiple-ids-in-eloquent</a></br>
        Get records with multiple ids
    </li>
    <li>
        <a href="https://stackoverflow.com/questions/35147366">/check-if-a-value-exists-in-array-laravel-or-php</a></br>
        check if a value exists in array
    </li>
    <li>
        <a href="https://stackoverflow.com/questions/32693688">/remove-quot-from-json-using-laravel</a></br>
        Use laravel eloquent controller data in JavaScript
    </li>
</ul>

# <a>Other</a>
## Difficulties
<ul>
    <li>
        <a href="https://www.youtube.com/watch?v=R1BMnDrIV7Y&list=PLGsnrfn8XzXir-hMxFje5t67igMN8v7ZT">Mike Derycke</a></br>
        Courses and these video's
    </li>
    <li>
        <a href="https://github.com/EHB-MCT/full-projects-4-goat">Group work</a></br>
        Model relations</br>
        Roles and permissions
    </li>
    <li>
        <a href="https://advancedwebtuts.com/tutorial/how-to-add-two-string-type-variables-in-laravel">advancedwebtuts</a></br>
        Concat two string variables in laravel
    </li>
    <li>
        <a href="https://www.youtube.com/watch?v=CNCE1gts2Yw">Eddie Jaoude</a></br>
        Protected my main branch from accidental commits
    </li>
    <li>
        <a href="https://spatie.be/docs/laravel-permission/v5/installation-laravel">Spatie</a></br>
        Spatie setup on laravel</br>
        Roles and permissions
    </li>
    <li>
        <a href="https://newbedev.com/how-to-manually-create-a-new-empty-eloquent-collection-in-laravel-4">Newbedev</a></br>
        Make clean collection instead of array
    </li>
    <li>
        <a href="https://www.tutsmake.com/laravel-8-charts-js-tutorial-example/">tutsmake</a></br>
        Setting up charts in laravel
    </li>
    <li>
        <a href="https://www.chartjs.org/docs/latest/">chartjs</a></br>
        Setting up charts
    </li>
    <li>
        <a href="https://iqcode.com/code/php/how-to-add-values-to-an-array-in-laravel">Iqcode</a></br>
        Add values to array
    </li>
</ul>