# Welcome to your Laravel project for Assignment 3

The actual assignment description is written in [instructions.md](../instructions.md), this file only contains the steps needed to get your project up and running

## Prerequisites
- You must have PHP >=8.2 [Download link](https://www.php.net/downloads)
- (if on Windows) You must have these PHP extensions enabled (enabled in the php.ini file)
    - Ctype, cURL, DOM, Fileinfo, Filter, Hash, Mbstring, OpenSSL, PCRE, PDO, Session, Tokenizer, XML
- You must have composer installed [Download link](https://getcomposer.org/download/)
- You must have NodeJS installed [Download link](https://nodejs.org/en/download)
- **OPTIONAL** for easier debugging we recommend also having Docker installed but it is not a requirement for completing the assignment [Download link](https://www.docker.com/get-started/)


## Getting started
When first starting with your [Laravel](https://laravel.com/docs/12.x) project there are a few steps that you have to do before you can start development.
<ol>
    <li>Run <code>composer install</code></li>
    <li>Run <code>npm install</code></li>
    <li>Run <code>cp .env.example .env</code></li>
    <li>Run <code>php .\artisan key:generate</code></li>
    <li><b>These next steps are only relevant if you have Docker installed (RECOMMENDED!)</b>
        <ol type="a">
            <li>In the <code>.env</code> uncomment line 24-28 and change <code>DB_CONNECTION</code> from <code>sqlite</code> to <code>mysql</code></li>
            <li>Set a password in the <code>DB_PASSWORD</code> field</li>
            <li>Run <code>docker-compose up -d</code></li>
        </ol>
    </li>
    <li>Run <code>php artisan migrate</code></li>
    <li>If you are not using Docker we recommend either hooking yout IDE up to the SQLite database (`database/database.sqlite`) or getting a separate tool for it </li>
</ol>
All done! You are now ready to start the assignment

**Bonus**
If you are using [PHPStorm](https://www.jetbrains.com/phpstorm/laravel/) we highly recommend also installing the [Laravel Idea](https://plugins.jetbrains.com/plugin/13441-laravel-idea) plugin which adds advanced Laravel specific intellisense along with other tools/assists for Laravel development

## Development
When developing you just simply run `php artisan serve` which will start your Laravel app.
If you are using docker you also need to run `docker-compose up -d`, we have provided you with an PHPMyAdmin instance for easy database management. It can be accessed on `http://127.0.0.1:8036/`

## Testing
If you want to run the tests locally you can run `php artisan dusk`.
This will excecute the automated browser tests which are also run when comitting to GitLab.
