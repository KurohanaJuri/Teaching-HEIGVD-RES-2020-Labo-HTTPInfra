FROM node:12.16

COPY src/ /opt/app

COPY ./install-npm-dependance.sh /
RUN chmod +x /install-npm-dependance.sh

ENTRYPOINT [ "/install-npm-dependance.sh" ]

#RUN curl -sL https://deb.nodesource.com/setup_12.x | bash
#RUN apt-get install -y nodejs

# Excute index.js
CMD ["node", "/opt/app/index.js"]