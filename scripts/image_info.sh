#!/bin/bash

# Usage: image_info.sh visus_exe file_path
#echo $1 $2 
export CONVERT=$1
$CONVERT info "$2" 