#!/usr/bin/env bash
export DEBIAN_FRONTEND=noninteractive

printf "Post installs"

echo "Cleanup xdebug"
if [ -L /etc/php/7.0/cli/conf.d/20-xdebug.ini ]; then
    printf "Disabling Xdebug for compilation - cli"
    rm -f /etc/php/7.0/cli/conf.d/20-xdebug.ini
fi

if [ -L /etc/php/7.0/fpm/conf.d/20-xdebug.ini ]; then
    printf "Disabling Xdebug for compilation - fpm"
    rm -f /etc/php/7.0/fpm/conf.d/20-xdebug.ini
fi

[ -r /etc/lsb-release ] && . /etc/lsb-release

if [ -z "$DISTRIB_RELEASE" ] && [ -x /usr/bin/lsb_release ]; then
    # Fall back to using the very slow lsb_release utility
    DISTRIB_RELEASE=$(lsb_release -s -r)
    DISTRIB_CODENAME=$(lsb_release -s -c)
fi

echo "Build and install Source packages below here ..."

echo "Building none"

#echo "Example Building MSGPACK"
#
#ZDIR=/usr/local/src/msgpack-c
#if [ ! -d "$ZDIR" ]; then
#    echo "Compiling..."
#    cd /usr/local/src && git clone https://github.com/msgpack/msgpack-c.git && cd msgpack-c && cmake . && make && make install
#    #/sbin/ldconfig
#else
#    echo "MSGPACK source already present ..."
#fi
