#!/bin/bash

php symfony doctrine:drop-db
mysqladmin create charityhack -u charityhack -phacktheplanet
php symfony doctrine:insert-sql
php symfony doctrine:data-load

