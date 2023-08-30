#!/bin/sh
php artisan queue:work --daemon --tries=4 --sleep=5
