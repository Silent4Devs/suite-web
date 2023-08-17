#!/bin/sh
php queue:work --daemon --tries=4 --sleep=5
