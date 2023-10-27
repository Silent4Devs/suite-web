pipeline {
    agent any
    environment {
        // Define environment variables
        DEPLOY_SERVER = '192.168.9.78'
        DEPLOY_USER = 'desarrollo'
        DEPLOY_DIR = '/var/contenedor/tabantaj'
    }
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Build and Test') {
            steps {
                // Build your Docker image using the Dockerfile
                sh "docker-compose build --no-cache"
                // Run your tests inside the Docker container
                sh "docker-compose up"
            }
        }
        stage('Push to Container Registry') {
            steps {
                // Push the Docker image to your container registry
                withCredentials([usernamePassword(credentialsId: 'your_registry_creds_id', usernameVariable: 'desarrollo', passwordVariable: 'S3cur3.qa')]) {
                    sh "docker login -u $USERNAME -p $PASSWORD $DOCKER_REGISTRY_URL"
                }
            }
        }
        stage('Deploy') {
            steps {
                // SSH into the deployment server and pull the Docker image
                sshagent(['your_ssh_credentials_id']) {
                    sh "ssh ${DEPLOY_USER}@${DEPLOY_SERVER} 'git pull"
                }
                // Start the Docker container on the deployment server
                sshagent(['your_ssh_credentials_id']) {
                    sh "ssh ${DEPLOY_USER}@${DEPLOY_SERVER} 'docker run -d -p 80:80 --name tabantaj'"
                }
            }
        }
    }
}
