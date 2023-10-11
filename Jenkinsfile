pipeline {
    agent any

    stages {
        stage('Limpieza de Espacio de Trabajo') {
            steps {
                deleteDir()
            }
        }

        stage('Build') {
            steps {
                git 'https://gitlab.com/silent4business/tabantaj.git'
                sh 'docker-compose up --build -d'
                sh 'docker-compose exec php composer install'
                sh 'docker-compose exec php php artisan key:generate'
                sh 'docker-compose exec php php artisan migrate'
            }
        }

        stage('Desplegar en Desarrollo') {
            steps {
                  sh "cd var/www/tabantaj && git fetch origin develop:develop && git checkout develop && git pull develop"
            }
        }

        stage('Pruebas de Aceptación') {
            steps {
                sh 'vendor/bin/behat'
                sh 'npm install'
                sh 'npm run build'
                sh 'npm test'
            }
        }

        stage('Desplegar en Stagging') {
            steps {
                sh 'ssh desarrollo@192.168.9.111 "cd  var/contenedores/tabantaj && git pull"'
            }
        }

      }

     post {
        success {
            echo 'Pipeline exitoso, se ha desplegado en stagging.'
        }
        failure {
            echo 'Pipeline fallido, no se ha desplegado en stagging.'
        }
    }
}
