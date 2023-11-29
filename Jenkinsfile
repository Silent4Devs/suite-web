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

        // stage('Deploy via SSH') {
        //     steps {
        //         script {
        //             sshagent(['/root/.ssh/id_rsa.pub']) {
        //                 sh 'scp -r $WORKSPACE/* desarrollo@192.168.9.78:/var/contenedor/tabantaj'
        //             }
        //         }
        //     }
        // }

        stage('Deploy from Development Server to Produccion Server') {
            steps {
                script {
                      sshagent(['/root/.ssh/id_rsa']) {
                       sh 'scp  -r $WORKSPACE/* root@192.168.9.101:/var/adm'
                     }
                }
            }
        }



    }
}
