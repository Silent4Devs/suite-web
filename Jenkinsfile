pipeline {
    agent any
    environment {
        GIT_CREDENTIALS = 'github-credentials'
        SSH_CREDENTIALS = 'ssh-deploy-key'
        DEPLOY_SERVER = '192.168.9.78'
        DEPLOY_PATH = '/var/contenedor/suite-web'
    }
    stages {
        stage('Clone Repository') {
            steps {
                script {
                    git credentialsId: "${env.GIT_CREDENTIALS}",
                        branch: 'develop_Onpremise',
                        url: 'https://github.com/Silent4Devs/suite-web.git'
                }
            }
        }

        stage('Deploy via SCP') {
            steps {
                script {
                    sshagent(credentials: ["${env.SSH_CREDENTIALS}"]) {
                        sh """
                        scp -o StrictHostKeyChecking=no -r "$WORKSPACE/"* desarrollo@${env.DEPLOY_SERVER}:${env.DEPLOY_PATH}
                        """
                    }
                }
            }
        }
    }
}
