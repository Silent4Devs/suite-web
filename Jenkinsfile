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

                            # Crea un archivo de configuración SSH temporal
                            echo "Host $SERVER_IP\n    StrictHostKeyChecking=no\n" > /tmp/ssh_config

                            # Realiza la conexión SSH y ejecuta el comando de git pull
                            sshpass -p $SSH_PASSWORD ssh -F /tmp/ssh_config $SSH_USER@$SERVER_IP "cd /var/contenedor/suite-web && echo $SSH_PASSWORD | sudo -S git pull"

                            # Elimina el archivo de configuración SSH temporal
                            rm /tmp/ssh_config
                        '''
                    }
                }
            }
        }
    }
}
