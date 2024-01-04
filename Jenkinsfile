pipeline {
    agent any
    stages {
        stage('Declarative: Checkout SCM') {
            steps {
                checkout scm
            }
        }

       stage('Install') {
            steps {
                git branch: 'develop', url: 'https://github.com/Silent4Devs/suite-web.git'
            }
        }


        stage('Build') {
            steps {
                script {
                    try {
                        sh 'docker-compose exec php cp .env.example .env'
                        sh 'docker-compose exec php composer install --ignore-platform-reqs'
                        sh 'docker-compose exec php php artisan key:generate'
                        sh 'docker-compose exec php php artisan migrate'
                        sh 'docker-compose exec php chmod 777 -R storage'
                        sh 'docker-compose exec php php artisan optimize:clear'
                    } catch (Exception e) {
                        echo 'Exception occurred: ' + e.toString()
                    }
                }
            }
        }


        stage('Permisos') {
            steps {
                script {
                    dir('/var/contenedor/suite-web') {
                        // Ejecutar comandos en el directorio
                        sh 'ls -la'  // Puedes agregar comandos adicionales aquí
                        sh 'chmod -R 777 /var/contenedor/suite-web'
                    }
              }
            }
        }

        stage('Deploy via SSH') {
            steps {
                script {
                    sshagent(['/root/.ssh/id_rsa.pub']) {
                        sh 'scp -r $WORKSPACE/* desarrollo@192.168.9.78:/var/contenedor/suite-web'
                    }
                }
            }
        }


        stage('Jenkis2 - Stage 1') {
            steps {
                script {
                    load 'Jenkinsfilev1'
                }
            }
        }
    }
}
