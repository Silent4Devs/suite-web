pipeline {
    agent any
    stages {
        stage('Install') {
            steps {
                git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
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


        stage('TESTING') {
            steps {
                script {
                    sh 'cd  /Testing/Calendario'
                    sh 'pytest test_calendario.py'
                }
            }
        }

        stage('Deploy via SSH') {
            steps {
                script {
                    if (true) {
                        sshagent(['/root/.ssh/id_rsa.pub']) {
                            sh 'scp -r $WORKSPACE/* desarrollo@192.168.9.78:/var/contenedor/tabantaj/'
                        }
                    } else {
                        echo 'Despliegue deshabilitado. No se realizarán acciones.'
                    }
                }
            }
        }

    }
}
