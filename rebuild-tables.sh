#!/bin/bash

if [ -x /home/solarspeed/php/bin/php ]; then
  alias php=/home/solarspeed/php/bin/php
fi 

php symfony doctrine:drop-db
mysqladmin create charityhack
php symfony doctrine:insert-sql
php symfony doctrine:data-load

