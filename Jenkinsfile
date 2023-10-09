pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build') {
            steps {
                sh 'docker-compose up --build -d'
                sh 'docker-compose exec php composer install'
                sh 'docker-compose exec php php artisan key:generate'
                //sh 'php artisan test'
            }
        }

        stage('Docker Compose Build and Publish') {
            steps {
                sh 'docker-compose up --build -d'
                sh 'docker-compose exec php php artisan migrate'
            }
        }

        stage('Deploy') {
            steps {
                sh 'echo aqui deploya'
            }
        }
    }

    post {
        always {
            sh 'docker-compose down'
        }
    }
}
