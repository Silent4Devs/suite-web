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
                echo 'Installing dependencies...'
                git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
            }
        }

        stage('Build') {
            steps {
                echo 'Build dependencies...'
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

        stage('Jenkis2') {
            steps {
                script {
                    load 'Jenkinsfilev1'
                }
            }
        }
    }
}
