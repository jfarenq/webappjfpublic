dcip=$(ip a |grep 172 | grep "inet\b" | awk '{print $2}' | cut -d/ -f1)
dchn=$(hostname)
sed "s/JFDCIP/$dcip/g" /usr/share/nginx/html/jf_sample.html >/usr/share/nginx/html/jf.html
sed -i "s/JFDCHN/$dchn/g" /usr/share/nginx/html/jf.html
