pipeline {
    agent any

    environment {
        DOCKER_IMAGE = 'nginx:stable-alpine'
        STAGING_ENV_FILE = '.env.stagging'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Deploy to Staging') {
            steps {
                script {
                    // Configuración del entorno de Staging
                    sh "cp ${STAGING_ENV_FILE} .env"

                    // Construir y subir la imagen Docker
                    sh "docker build -t ${DOCKER_IMAGE} ."
                    sh "docker push ${DOCKER_IMAGE}"

                    // Desplegar en el entorno de Staging
                    sh "docker-compose -f docker-compose.yml up -d"
                }
            }
        }
    }

    post {
        success {
            echo 'Despliegue a Staging exitoso!'
        }
        failure {
            echo 'Fallo en el despliegue a Staging.'
        }
    }
}
