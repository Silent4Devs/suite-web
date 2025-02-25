pipeline {
    agent any
    environment {
        DEPLOY_SERVER = '192.168.9.78'
        DEPLOY_PATH = '/var/contenedor/suite-web'
    }
    stages {
        stage('Deploy via SSH') {
            steps {
                script {
                    withCredentials([
                        usernamePassword(credentialsId: 'QA-CREDENCIALES', usernameVariable: 'SSH_USER', passwordVariable: 'SSH_PASS'),
                        string(credentialsId: 'GITHUB_PAT_TOKEN', variable: 'GITHUB_TOKEN')  
                    ]) {
                        sh """
                            sshpass -p "$SSH_PASS" ssh -o StrictHostKeyChecking=no ${SSH_USER}@${DEPLOY_SERVER} << 'EOF'
                                cd ${DEPLOY_PATH}

                                echo "$SSH_PASS" | sudo -S chmod -R 777 ${DEPLOY_PATH}

                                echo "$SSH_PASS" | sudo -S git pull https://jonathansilent:${GITHUB_TOKEN}@github.com/Silent4Devs/suite-web.git develop_Onpremise

                                echo "$SSH_PASS" | sudo -S chmod -R 777 ${DEPLOY_PATH}
                            EOF
                        """
                    }
                }
            }
        }
    }
}

