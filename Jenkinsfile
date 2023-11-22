pipeline {
    agent any

    environment {
        DOCKER_COMPOSE_FILE = 'docker-compose.yml'
        DOCKER_IMAGE = 'nginx-tabantaj:latest'
        SSH_DEPLOY_USER = 'desarrollo'
        SSH_DEPLOY_HOST = '192.168.9.78'
        SSH_DEPLOY_PORT = 22
        GIT_REPO_URL = 'https://gitlab.com/silent4business/tabantaj.git'
        GIT_BRANCH_DEVELOP = 'develop'
        GIT_BRANCH_STAGING = 'stagging'
        DEPLOY_DIRECTORY = '/var/contenedor/tabantaj'
    }

    stages {
        stage('Clonar Repositorio') {
            steps {
                git branch: GIT_BRANCH_DEVELOP, url: GIT_REPO_URL
            }
        }

        stage('Build Docker Image') {
        steps {
                 script {
                    // Montar el socket de Docker
                    def dockerSocket = '/var/run/docker.sock'
                    def dockerCommand = 'docker'

                    // Verificar si estamos en un sistema Linux
                    if (isUnix()) {
                    // Cambiar a usuario root
                    sh 'docker build -t nginx-tabantaj:latest -f docker/Dockerfile .'
                    }

                    // Construir la imagen Docker
                    sh "${dockerCommand} build -t nginx-tabantaj:latest -f docker/Dockerfile ."
                }
            }
        }


        stage('Construir Contenedor Docker') {
            steps {
                script {
                    docker.build DOCKER_IMAGE, "-f docker/Dockerfile ."
                }
            }
        }

        stage('Desplegar en Docker Compose') {
            steps {
                script {
                    sh "scp -o StrictHostKeyChecking=no -P ${SSH_DEPLOY_PORT} docker-compose.yml ${SSH_DEPLOY_USER}@${SSH_DEPLOY_HOST}:${DEPLOY_DIRECTORY}/"
                    sh "scp -o StrictHostKeyChecking=no -P ${SSH_DEPLOY_PORT} .env ${SSH_DEPLOY_USER}@${SSH_DEPLOY_HOST}:${DEPLOY_DIRECTORY}/"
                    sh "ssh -o StrictHostKeyChecking=no -p ${SSH_DEPLOY_PORT} ${SSH_DEPLOY_USER}@${SSH_DEPLOY_HOST} 'cd ${DEPLOY_DIRECTORY} && docker-compose pull && docker-compose up -d'"
                }
            }
        }
    }

    post {
        success {
            echo 'Despliegue exitoso!'
        }
        failure {
            echo 'Error en el despliegue. Revisar los registros para más detalles.'
        }
    }
}
