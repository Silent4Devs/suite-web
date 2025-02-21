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
                        chmod -R 755 "${WORKSPACE}"
                        """
                        
                        sh """
                            sshpass -p "$SSH_PASS" ssh -o StrictHostKeyChecking=no ${SSH_USER}@${env.DEPLOY_SERVER} 'echo $SSH_PASS | sudo -S chmod -R 755 /var/contenedor/suite-web'
                        """

                        sh """
                        sshpass -p "$SSH_PASS" scp -v -o StrictHostKeyChecking=no -r "$WORKSPACE/"* ${SSH_USER}@${env.DEPLOY_SERVER}:${env.DEPLOY_PATH}
                        """
                    }
                }
            }
        }
    }
}
