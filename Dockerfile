FROM php:8.2-cli
COPY . /usr/src/patterns
WORKDIR /usr/src/patterns

CMD [ "/bin/sh", "pwd" ]
CMD [ "/bin/sh", "ls -la" ]
CMD [ "php", "/usr/src/patterns/your-script.php" ]