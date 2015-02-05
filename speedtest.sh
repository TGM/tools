#!/bin/sh

date

# 2818 RCS-RDS (Bucharest, Romania)
# 851  RCS-RDS (Iasi, Romania)
# 4935 RCS-RDS (Timisoara, Romania)

for i in 2818 851 4935
do
	speedtest --server $i --share --simple
done
