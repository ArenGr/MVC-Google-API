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
# Function to run Docker Compose
run_docker_compose() {
    echo "Running Docker Compose..."
    docker-compose up -d
}

get_mysql_container_id() {
    echo "Getting MySQL container ID..."
    mysql_container_id=$(docker ps --filter "ancestor=mysql" --format "{{.ID}}")
    echo "MySQL container ID: $mysql_container_id"
}

create_user_with_admin_privileges() {
    echo "Creating user with admin privileges..."
    docker exec -i $mysql_container_id mysql -uroot -prootpassword -e "CREATE USER 'admin'@'%' IDENTIFIED BY 'admin';"
    docker exec -i $mysql_container_id mysql -uroot -prootpassword -e "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%';"
    docker exec -i $mysql_container_id mysql -uroot -prootpassword -e "FLUSH PRIVILEGES;"
}

create_database() {
    echo "Creating database using admin user credentials..."
    docker exec -i $mysql_container_id mysql -uadmin -padmin -e "CREATE DATABASE your_database_name;"
}

#run_migration_with_composer() {
#    echo "Running migration with Composer..."
#    composer run:migration
#}

main() {
    install_composer_dependencies
    install_npm_dependencies_and_gulp
    create_symlink_with_composer
    run_docker_compose
    get_mysql_container_id
    create_user_with_admin_privileges
    create_database
}

main