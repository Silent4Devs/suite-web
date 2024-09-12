pipeline {
    agent any

    stages {
        stage('Git Pull via SSH') {
            steps {
                script {
                    withCredentials([
                        usernamePassword(credentialsId: 'TabantajQa', usernameVariable: 'SSH_USER', passwordVariable: 'SSH_PASSWORD'),
                        string(credentialsId: 'IpQaTabantaj', variable: 'SERVER_IP')
                    ]) {
                        sh '''
                            echo $SSH_PASSWORD | sshpass -p $SSH_PASSWORD ssh $SSH_USER@$SERVER_IP "cd /var/contenedor/suite-web && sudo -S git pull"
                        '''
                    }
                }
            }
        }
    }
}
