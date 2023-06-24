FROM dpage/pgadmin4:latest

RUN addgroup -g 1000 pgadmin \
    && adduser -u 1000 -G pgadmin -s /bin/sh -D pgadmin
USER pgadmin
