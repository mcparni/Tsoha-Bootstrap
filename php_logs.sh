#!/bin/bash

source config/environment.sh

ssh $USERNAME@$SERVER '
tail -f /home/userlogs/$USER.error'
