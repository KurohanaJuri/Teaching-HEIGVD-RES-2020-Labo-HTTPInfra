FROM node:12.16

WORKDIR /opt/app

COPY src/ /opt/app

COPY ./install-npm-dependance.sh /

RUN chmod +x /install-npm-dependance.sh

RUN npm install


ENTRYPOINT [ "/install-npm-dependance.sh" ]

# Excute index.js
CMD ["node", "/opt/app/index.js"]