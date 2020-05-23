FROM node:12.16

# install nano
RUN apt-get update && apt-get install nano

WORKDIR /opt/app

COPY src/ /opt/app

RUN npm install

# Excute index.js
CMD ["node", "/opt/app/index.js"]