dockerid=$(docker ps |grep jfwebphp |awk '{print $1}')
docker stop $dockerid
docker rm $dockerid
