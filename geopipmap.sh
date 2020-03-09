#!/bin/bash
SSHSERVER="localhost"

DDAY=`date "+%d"|sed -e s/"^0"/" "/g`
DMONTH=`date "+%b"`
DTM=$(date +"%Y-%m-%d")
LOGFILE="sshfailed.$DTM.log"
DOCUMENTROOT=`cat /etc/httpd/conf/httpd.conf |grep DocumentRoot |cut -d"\"" -f2 |grep -v "#"`
BASEWWWDIR="geoip"
APIURI=`http://localhost/geoip/api`
NOMAPI="geoip.php"

for arg in "$@"
do
    case $arg in



	-b|--build)
        FUNCTION="build"
        shift # Remove --cache= from processing
        ;;

	-g|--geoip)
        GEOIP="yes"
        shift # Remove --cache= from processing
        ;;

	-c|--category=*)
        CAT="${arg#*=}"
        shift # Remove --cache= from processing
        ;;

	-H=*|--host=*)
        SSHSERVER="${arg#*=}"
        shift # Remove --cache= from processing
        ;;


# ... and so on
   esac
done

echo "Retrieve /var/log/secure from $SSHSERVER at $DMONTH $DDAY..."
echo "grep \"^$DMONTH $DDAY\" /var/log/secure |grep \"Failed password\"|awk -v FS=from '{print \$2}' |awk {'print \$1'} "
ssh root@$SSHSERVER "grep \"^$DMONTH $DDAY\" /var/log/secure |grep \"Failed password\"|awk -v FS=from '{print \$2}' |awk {'print \$1'} |sort -un" >$LOGFILE


for i in `cat $LOGFILE |sort -un`
do
	 # Make Geoip DB for each host in secure.log
	HOST=${i}
	if [ "$HOST" == "" ]; then
	 
		echo "Syntax error, you must provide FQDN or IP address"
	else

		DTM=$(date +"%Y/%d/%m")
		DTT=$(date +"%H:%M:%S")
		sshgeoip=$(curl -s https://ip.seeip.org/geoip/$HOST)
		DATGEOIP=`echo $sshgeoip |sed -e s/"\""/""/g|sed -e s/":"/"="/g|sed -e s/"{"/""/g |sed -e s/"}"/""/g |sed -e s/"\,"/"\&"/g`
		echo $DATGEOIP"&date=$DTM $DTT&cat=$CAT"
		DATAS=$DATGEOIP"&date=$DTM $DTT&cat=$CAT"
		DAT_ENCODED=`echo $DATAS |sed -e s/" "/"%20"/g`
		APICALL="${APIURI}${MONAPI}?method=add-geoip&${DAT_ENCODED}"
		curl "$APICALL" >/dev/null 2>/dev/null
		if [ "$?" == "0" ]; then
			echo "[$DTM $DTT] $HOST GeoIP logger :  Done"
		else
			echo "[$DTM $DTT] $HOST GeoIP logger : failed"
		fi
	fi

done

# Create JSON file from DB 
if [ "$CAT" == "" ]; then 
		APICALL="${APIURI}${MONAPI}?method=stats-cat-geoip&cat="
		curl "$APICALL"
		curl "$APICALL">${DOCUMENTROOT}/${BASEWWWDIR}/json/${CAT}.json
else
		APICALL="${APIURI}${MONAPI}?method=stats-cat-geoip&cat=$CAT"
		curl "$APICALL"
		curl "$APICALL">${DOCUMENTROOT}/${BASEWWWDIR}/json/${CAT}.json
fi

