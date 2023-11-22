pipeline {
    agent any

    environment {
        QA_SERVER = 'desarrollo@192.168.9.78'
        QA_PASSWORD = 'S3cur3.qa'
        COMPOSE_FILE = 'docker-compose.yml'
        DOCKER_IMAGE = 'nginx:stable-alpine'
    }

    stages {
        stage('Deploy to QA') {
            when {
                branch 'develop'
            }
            steps {
                script {
                    def sshCmd = "sshpass -p ${QA_PASSWORD} ssh ${QA_SERVER}"

                    // Loguearse en el servidor QA
                    sh "${sshCmd} 'cd /var/contenedor/tabantaj && git pull origin develop'"

                    // Actualizar la imagen Docker en el servidor QA
                    sh "${sshCmd} 'docker pull ${DOCKER_IMAGE}'"

                    // Detener y eliminar los contenedores existentes
                    sh "${sshCmd} 'docker-compose -f ${COMPOSE_FILE} down'"

                    // Iniciar los contenedores con Docker Compose
                    sh "${sshCmd} 'docker-compose -f ${COMPOSE_FILE} up -d'"
                }
            }
        }
    }
}
