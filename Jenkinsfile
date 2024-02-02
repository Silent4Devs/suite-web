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


        stage('Deploy via SSH') {
            steps {
                script {
                    sshagent(['/root/.ssh/id_rsa.pub']) {
                        sh 'scp -r $WORKSPACE/* desarrollo@192.168.9.78:/var/contenedor/suite-web'
                    }
                }
            }
        }

        post {
                always {
                    emailext (
                        subject: "Despliegue exitoso",
                        body: "El despliegue de la aplicación fue exitoso.",
                        to: "saul.ramirez@silent4business.com",
                    )
                }
            }

    }
}
