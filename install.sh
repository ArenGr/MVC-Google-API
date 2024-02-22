#!/bin/bash

install_composer_dependencies() {
    echo "Installing Composer dependencies..."
    composer install
}

install_npm_dependencies_and_gulp() {
    echo "Installing npm dependencies..."
    npm install

    echo "Running gulp scripts..."
    npx gulp scripts
}

create_symlink_with_composer() {
    echo "Creating symlink with Composer..."
    composer make:symlink
}

run_docker_compose() {
    echo "Running Docker Compose..."
    docker-compose up -d
}

run_docker_compose() {
    echo "Running Docker Compose..."
    docker-compose up -d
}

echo_credentials() {

    echo "-------------------------------------------------------------------------------------------------------------"
    echo "Please update your .env file with the following credentials:"
    mysql_container_host=$(docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mvc-google-api_mysql_1)
    echo "DBHOST:$mysql_container_host"
    echo "DBNAME: test_mvc"
    echo "DBUSER: admin"
    echo "DBPASS: admin"
}

main() {
    install_composer_dependencies
    install_npm_dependencies_and_gulp
    create_symlink_with_composer
    run_docker_compose
    echo_credentials
}

main