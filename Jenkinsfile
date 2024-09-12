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
                            sshpass -p $SSH_PASSWORD ssh -o StrictHostKeyChecking=no $SSH_USER@$SERVER_IP <<EOF
                            cd /var/contenedor/suite-web
                            sudo git pull
                            EOF
                        '''
                    }
                }
            }
        }
    }
}
