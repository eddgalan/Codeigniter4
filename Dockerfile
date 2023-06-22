FROM debian:11.3
WORKDIR /var/www/html
COPY dependences.sh /var/www/html/dependences.sh
RUN sh dependences.sh
CMD apachectl -DFOREGROUND
