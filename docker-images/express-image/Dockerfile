FROM node:12.16

# install nano
RUN apt-get update && apt-get install nano

COPY src/ /opt/app

# Excute index.js
CMD ["node", "/opt/app/index.js"]