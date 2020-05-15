FROM node:12.16

COPY src/ /opt/app

COPY ./install-npm-dependance.sh /
RUN chmod +x /install-npm-dependance.sh

ENTRYPOINT [ "/install-npm-dependance.sh" ]

# Excute index.js
CMD ["node", "/opt/app/index.js"]