pipeline {
    agent any
    environment {
        GIT_CREDENTIALS = 'github-credentials'
        SSH_CREDENTIALS = 'QA-CREDENCIALES'
        DEPLOY_SERVER = '192.168.9.78'
        DEPLOY_PATH = '/var/contenedor/suite-web'
    }
    stages {

        stage('Deploy via SSH') {

            steps {
                script {
                    withCredentials([usernamePassword(credentialsId: 'QA-CREDENCIALES', usernameVariable: 'SSH_USER', passwordVariable: 'SSH_PASS')]) {
                        sh """

                            sshpass -p "$SSH_PASS" ssh -o StrictHostKeyChecking=no ${SSH_USER}@${DEPLOY_SERVER} "

                                cd ${DEPLOY_PATH} && 

                                git reset --hard && 
                                
                                git pull https://\$GITHUB_TOKEN@github.com/silent4business/kaxan2.git origin develop_Onpremise &&

                                sudo chmod -R 777 ${DEPLOY_PATH}

                            "

                        """

                    }
                }
            }
        }
    }
}
