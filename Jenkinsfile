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
                            # Elimina la clave antigua del archivo known_hosts
                            ssh-keygen -f "/root/.ssh/known_hosts" -R $SERVER_IP || true

                            # Realiza la conexión SSH y ejecuta los comandos
                            sshpass -p $SSH_PASSWORD ssh -o StrictHostKeyChecking=no $SSH_USER@$SERVER_IP <<'EOF'
                            cd /var/contenedor/suite-web
                            echo $SSH_PASSWORD | sudo -S git pull
                            EOF
                        '''
                    }
                }
            }
        }
    }
}
