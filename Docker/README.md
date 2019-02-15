# ////////////////////////////////////////////////////////////////  OpenVisus DataPortal Docker Image

For Windows:
```
set VISUS_DATASETS=C:\path\to\datasets\dir
set TAG=dataportal
docker build -t %TAG% -f Dockerfile .
docker run -d --name mydocker -v %VISUS_DATASETS%:/mnt/visus_datasets -p 8080:80 %TAG%
```

For osx/linux:
```
VISUS_DATASETS=/path/to/datasets/dir
set TAG=dataportal
docker build -t ${TAG} -f Dockerfile .
docker run -d --name mydocker -v ${VISUS_DATASETS}:/mnt/visus_datasets -p 8080:80 ${TAG}
```

If you want to run interactively, add **-it**, remove **-d**, and explicitly run /bin/bash:
```
docker run -it -v ${VISUS_DATASETS}:/mnt/visus_datasets -p 8080:80 ${TAG} /bin/bash
/usr/local/bin/httpd-foreground.sh
```

Notes:
* `-v <local_path>:<remote_path>` mounts local datasets directory and may be omitted to simply see it running
* `-p 8080:80` directs the server to run on host port 8080, but in the container it will appear to be port 80

#### To test the running container

- in another terminal, list datasets hosted by the container:

        curl  "http://0.0.0.0:8080/mod_visus?action=list"

- in a browser, open the dataportal: `http://0.0.0.0:8080`
    - try one of the "View" buttons for any of the datasets

- in a browser, open the webviewer directly: `http://0.0.0.0:8080/viewer`
    - change server name in viewer to: `http://0.0.0.0:8080/mod_visus?`

- in an interactive session (see above) you can also test the OpenVisus Python library:

        python3 /home/OpenVisus/Samples/python/Idx.py
        python3 /home/OpenVisus/Samples/python/Dataflow.py
        python3 /home/OpenVisus/Samples/python/Array.py

## Deploy to the repository

```
sudo docker login -u <username>
# TYPE the secret <password>

docker tag $TAG visus/$TAG
docker push visus/$TAG
```
