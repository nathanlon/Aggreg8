#!/bin/bash
cd src
#if [ -x /home/solarspeed/php/bin/php ]; then
  alias php=/home/solarspeed/php/bin/php
#fi 

/home/solarspeed/php/bin/php symfony doctrine:drop-db
mysqladmin create charityhack -u charityhack -p--passwordhere--
/home/solarspeed/php/bin/php symfony doctrine:insert-sql
/home/solarspeed/php/bin/php symfony doctrine:data-load

