#!/usr/bin/env bash

set -eaux

readonly root=`dirname $0`/sandbox/phpunit-project

mkdir -p $root
cd $root

