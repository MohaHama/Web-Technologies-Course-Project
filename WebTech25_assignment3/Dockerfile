FROM shinsenter/laravel:dev-php8.2

RUN export APP_PATH="."

RUN apt update
RUN mkdir downloads && \
    curl --output downloads/chrome-install.deb https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb && \
    apt-get update && \
    apt-get install -y ./downloads/chrome-install.deb && \
    rm -rf downloads

# Install Chromedriver matching Chrome version
RUN set -ex; \
    curl -Lo /tmp/chromedriver.zip "https://chromedriver.storage.googleapis.com/114.0.5735.90/chromedriver_linux64.zip"; \
    unzip /tmp/chromedriver.zip -d /usr/local/bin/; \
    chmod +x /usr/local/bin/chromedriver; \
    rm /tmp/chromedriver.zip

ENTRYPOINT [ "" ]
