pipeline {
    agent any
    environment {
        GIT_CREDENTIALS = 'github-credentials'
        SSH_CREDENTIALS = 'QA-CREDENCIALES'
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
                    withCredentials([usernamePassword(credentialsId: 'QA-CREDENCIALES', usernameVariable: 'SSH_USER', passwordVariable: 'SSH_PASS')]) {
                        sh """
                        sshpass -p "$SSH_PASS" ssh -o StrictHostKeyChecking=no "$SSH_USER"@${env.DEPLOY_SERVER} 'sudo chmod -R 777 ${env.DEPLOY_PATH} || exit 1'
                        sshpass -p "$SSH_PASS" scp -o StrictHostKeyChecking=no -r "$WORKSPACE/." "$SSH_USER"@${env.DEPLOY_SERVER}:${env.DEPLOY_PATH}
                        """
                    }
                }
            }
        }
    }
}
