# ivastly/regrest
FROM php:7.4-cli
RUN apt update \
    && apt install -y git
COPY . /app
WORKDIR /app
ENTRYPOINT ["/app/bin/regrest"]
