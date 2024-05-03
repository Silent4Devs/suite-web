pipeline {
    agent any

    environment {
        SSH_USER = 'desarrollo'
        SSH_PASSWORD = 'S3cur3.qa'
        SERVER_IP = '192.168.9.78'
    }

    stages {
        stage('Git Pull via SSH') {
            steps {
                script {
                   sh '''
                       echo $SSH_PASSWORD | sshpass -p $SSH_PASSWORD ssh $SSH_USER@$SERVER_IP "cd /var/contenedor/suite-web && sudo -S git pull"
                    '''
                }
            }
        }
    }

    stage('Download and Run Docker Image') {
            steps {
                script {
                    // Descargar la imagen Docker
                    sh "docker pull ghcr.io/silent4devs/pytest-suite-web:latest"

                    // Ejecutar la imagen Docker
                    sh "docker run --rm -v $PWD:/Testing pytest-suite-web:latest python pytest -vs tests/"
                }
            }
        }
    
}


