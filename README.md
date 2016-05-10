# Laravel Vue Starter

## Setting up

- set up a virtual host. You can either do it using [homestead built-in tools](https://laravel.com/docs/5.2/homestead#configuring-homestead) or by hand. Make sure to edit your _/etc/hosts_ file.
- Example _nginx.conf_:
```
server {
    listen 80;
    server_name lv-starter.dev;
    root "/www/laravel-vue-starter-template/public";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log off;
    error_log  /var/log/nginx/lv-starter.local-error.log error;

    sendfile off;

    client_max_body_size 100m;

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_intercept_errors off;
        fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
    }

    location ~ /\.ht {
        deny all;
    }
}
```
- cd to the root of the project
- run `composer istall`
- run `npm install`
- copy _.env.example_ to _.env_
- create a new mysql database to use in the app. By default it's callded _boilerplate_
- run `php artisan migrate --seed`
- at this point you should be able to open the app in your browser
- run `gulp; gulp watch` and start coding

## What's inside

- [bugsnag integration]()https://github.com/bugsnag/bugsnag-laravel. To enable it add a BUGNSAG_API_KEY variable in _.env_ and uncomment _/config/app.php:164_
- [slack integration](https://github.com/maknz/slack). To enable it create a webhook and set a SLACK_ENDPOINT variable in _.env_
- email integration - the configuration is pretty straightforward. Check out EMAIL_* variables in .env
- basic custom middlewares - _mastermind_ & _customer_
- 2 users - _mastermind@app.dev/password_ & _user@app.dev/password_
- php
    - _App\Jobs\SendEmail_ job - emails should be sent using this
    - _App\Jobs\SendSlackMessage_ job - for sending slack messages
    - rest api routes. There're several helper methods to return json data - `return $this->respondWith*()`
- javascript
    - [pjax links](https://github.com/defunkt/jquery-pjax). To make a pjax link just add a [data-pjax] attribute to it. Once clicked it will replace contents of #pjax-container with dynamically loaded html
    - vue.js app structure . To code a new page just add a [data-controller=controller/name] attribute to the parent div & include it in _/resources/js/vue/controllers.js_. There's an example controller that handles the profile page.
    - _/resources/js/misc/notify.js_ - helper library to show notifications and confirmation popups