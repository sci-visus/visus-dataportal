#!/bin/bash

# Usage: conver_single.sh visus_exe data_dir filename input_file dim dtype 
#echo $1 $2 $3 $4 $5 $6 
export CONVERT=$1
$CONVERT import "$4" --dtype "$6" --dims "$5" create "$2/$3.idx" #--time 0 --field data --box $4