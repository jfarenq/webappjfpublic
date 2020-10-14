imgarch=$(uname -m)
sed -i "s/JFARCH/$imgarch/g" www/index.html
case $imgarch in
  x86_64 )
    echo "Intel"
    sed -i 's/TMPLEARTH/earth_x86_64/g' www/index.html ;;
  ppc64le )
    echo "ppc64le"
    sed -i 's/TMPLEARTH/earth_ppc64le/g' www/index.html ;;
  s390x )
    echo "s390x"
    sed -i 's/TMPLEARTH/earth_s390x/g' /www/index.html ;;
  *)
    sed -i 's/TMPLEARTH/earth/g' /www/index.html ;;
esac

