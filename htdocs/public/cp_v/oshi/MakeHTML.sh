#! /bin/sh

# Me Shell Name
scriptName=`basename $0`
# Me ProceesID
scriptPid=$$
# config
event="oshi"
release_date=`basename $1`

isp="11"
isp_name="cp_v"

### index part
t="index"
sur="20240430"
if [ -n "${release_date}" ]; then
	sur=${release_date}
fi
QUERY_STRING="event=${event}&isp=${isp}&t=${t}&release_date=${sur}"

curl -Ss 'http://172.24.240.230:8080/cp_v/index.php' --data "${QUERY_STRING}" -XPOST -o index_${sur}.html.tmp

#if [ ! -f index_${sur}.html.tmp ] || [ ! -s index_${sur}.html.tmp ]; then
#	printf "%s[%d]: <warning>: Uncreate the contents html: %s\n" ${scriptName} ${scriptPid} index_${sur}.html
#else
#	printf "%s[%d]: <notice>: Update contents html: %s\n" ${scriptName} ${scriptPid} index_${sur}.html
#	#sed -e '1,2d' index_${sur}.html.tmp > index_${sur}.html
#	mv index_${sur}.html.tmp  index_${sur}.html
#fi


### input part
t="input"
for file in `find /srv/www/php/htdocs/cp_v/oshi/data/*.php -type f`
do
	file_name=`basename ${file}`
	menu_id=`echo ${file_name} | sed -e 's/.php//g'`

	if [ `echo ${menu_id} | grep 'oa'` ]; then
        if [ ${menu_id} != 'oa_002' ] && [ ${menu_id} != 'oa_004' ]; then
			QUERY_STRING="event=${event}&isp=${isp}&t=${t}&menu_id=${menu_id}"
			curl -Ss 'http://172.24.240.230:8080/cp_v/index.php' --data "${QUERY_STRING}" -XPOST -o ${menu_id}.html.tmp

			if [ ! -f ${menu_id}.html.tmp ] || [ ! -s ${menu_id}.html.tmp ] ; then
				printf "%s[%d]: <warning>: Uncreate the contents html: %s\n" ${scriptName} ${scriptPid} ${menu_id}.html
			else
				printf "%s[%d]: <notice>: Update contents html: %s\n" ${scriptName} ${scriptPid} ${menu_id}.html
				#sed -e '1,2d' ${menu_id}.html.tmp > ./input/${menu_id}.html
				mv ${menu_id}.html.tmp  ./input/${menu_id}.html
	        fi
		fi
	fi
done



rm -f ./*.tmp
