# Test widget to display random financial data

### About this project

This project implements the website containing client-side widget (Vue3 component that displays stock prices of random companies) and the custom API endpoint which provides the data for that widget.    

### Installation instructions

Clone the project repository. 

Install composer dependencies and run the JS build: 

```
composer install
yarn install
yarn encore prod
```

Copy `.env` file into `.env.local`. In this newly created file replace the `API_KEY` value with an actual key retrieved at [https://site.financialmodelingprep.com](https://site.financialmodelingprep.com).

Configure web server to use `public` subdirectory as website root directory. When configuring the server, note that all requests must be redirected to `public/index.php`. There is already an `.htaccess` file for that, but depending on server configuration you may have to add similar rules manually.

Make sure that server works properly. For example, let's say you have configured the `widget.local` domain for the project. Try to open the API endpoint URL in browser - `https://widget.local/api/widget_data` - and see if it displays a JSON object.

That's it, now you can open the website (`https://widget.local`) to see the widget.

### Widget configuration

By default, the widget displays a new random company info every 10 seconds. To change that interval:

- Open the `assets/components/App.vue` file.
- Replace the number `10` in the component call (`<widget :fetch-interval="10"></widget>`) with your own value.
- Rebuild the app by executing `yarn encore prod`.

### Testing

To run the PHPUnit tests of the backend part, execute:

```
php ./vendor/phpunit/phpunit/phpunit ./Tests
```