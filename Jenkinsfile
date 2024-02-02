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
                git branch: 'develop', credentialsId: 'dev', url: 'https://github.com/Silent4Devs/suite-web.git'
                git branch: 'stagging', credentialsId: 'dev', url: 'https://github.com/Silent4Devs/suite-web.git'
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


        stage('Merge') {
            steps {
                sh 'git checkout stagging'
                sh 'git merge develop'
                sh 'git push origin stagging'
            }
        }

    }
}
