#!/bin/bash

# Delete all data on one or multiple disks

# Drive letters from B to Z, if you are using a CDROM to boot you can start from A
# This version does not support SSD drives properly as S.M.A.R.T attributes are different
for letter in {b..z} ; do
    if [ -b /dev/sd$letter ];
    then
	echo '!!! WARNING !!! Starting DISK initialization for:'
        smartctl -a /dev/sd$letter | egrep "Serial|Reallocated|Power_On"
        dd if=/dev/zero of=/dev/sd$letter bs=1M count=100
        dd if=/dev/zero of=/dev/sd$letter bs=512 seek=$(($(blockdev --getsz /dev/sd$letter)-65536))
    fi
done
