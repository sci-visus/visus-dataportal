FROM visus/anaconda

# install required libraries
RUN apt-get update
RUN apt-get install -y git php php-xml php-curl php-json php-sqlite3 libapache2-mod-php 

RUN conda install -c conda-forge pydicom gdcm

# install dataportal
RUN git clone https://github.com/sci-visus/visus-dataportal ${VISUS_HOME}/dataportal
WORKDIR ${VISUS_HOME}/dataportal
RUN git submodule update --init -- ext
ADD dataportal.conf  /etc/apache2/sites-enabled/dataportal.conf
ADD local.docker.php  ${VISUS_HOME}/dataportal/local.php
ADD local.docker.js   ${VISUS_HOME}/dataportal/local.js
ADD .htpasswd         ${VISUS_HOME}/.htpasswd
ADD .htaccess         ${VISUS_HOME}/dataportal/.htaccess
ADD server-tuning.conf /etc/apache2/mods-enabled/server-tuning.conf
# RUN chmod 777 /etc/apache2/mods-enabled/server-tuning.conf
RUN chgrp -R www-data ${VISUS_HOME}/dataportal
# create token file for Box (with write permissions)
RUN touch ${VISUS_HOME}/dataportal/upload/plugins/box/token.box
RUN chown www-data ${VISUS_HOME}/dataportal/upload/plugins/box/token.box
RUN chmod 770 ${VISUS_HOME}/dataportal/upload/plugins/box/token.box

# visus.config needs write permissions
RUN chgrp www-data ${VISUS_HOME}/visus.config
RUN chmod g+w       ${VISUS_HOME}/visus.config

# db needs write permissions
RUN chmod -R g+w       ${VISUS_HOME}/dataportal/db

# data folder needs write permissions
RUN mkdir /data
RUN chgrp -R www-data /data
RUN chmod -R g+w      /data
RUN mkdir /data/.trash/
RUN chgrp www-data /data/.trash/
RUN chmod g+w /data/.trash
RUN mkdir /converted
RUN chgrp -R www-data /converted
RUN chmod -R g+w      /converted
# webviewer config
ADD config.js       ${VISUS_HOME}/dataportal/ext/visus/config.js
RUN rm              /etc/apache2/sites-enabled/000-default.conf  

WORKDIR ${VISUS_HOME}

EXPOSE 80
CMD ["/usr/local/bin/httpd-foreground.sh"]
