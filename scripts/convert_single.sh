#!/bin/bash

# Usage: conver_single.sh data_dir filename input_file box dim dtype 
#echo $1 $2 $3 $4 $5 $6 
export CONVERT=visus
#$CONVERT create "$1/$2.idx" --box "$4" --fields "data $6" --time 0 0 time%04d/

$CONVERT import "$3" --dtype "$6" --dims "$5" create "$1/$2.idx" #--time 0 --field data --box $4