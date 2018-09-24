# !/bin/bash
while read mac; do
	echo $mac
	found=0
	u_mac=$(sed -e 's/.*	\(.*\)/\1/' <<< $mac)
	id=$(sed -e 's/\(.*\)	.*/\1/' <<< $mac)
	
	for con in `cat mac.txt`; do
		if [ "$u_mac" == "$(sed -e 's/\(.*\)/\L\1/' <<< $con)" ] 
		then
			echo "It is a match! with user $id"
			mysql -u ulimartinez -pmarzo2696 -D home_users -e "UPDATE user_status SET status=1, last_update=NOW() WHERE u_id=$id"
			found=1
		fi
	done

	if [ -z $found ]
	then
		mysql -u ulimartinez -pmarzo2696 -D home_users -e "UPDATE user_status SET status=0, last_update=NOW() WHERE u_id=$id"
	fi

done <<<"$(mysql -u ulimartinez -pmarzo2696 -D home_users -N -B -e "SELECT user.id, user.mac FROM user INNER JOIN subscribed ON user.id=subscribed.u_id;")"
