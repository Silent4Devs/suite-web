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

        // stage('Execute unit test docker') {
        //     steps {
        //         script {
        //             withCredentials([
        //                 usernamePassword(credentialsId: 'TabantajQa', usernameVariable: 'SSH_USER', passwordVariable: 'SSH_PASSWORD'),
        //                 string(credentialsId: 'IpQaTabantaj', variable: 'SERVER_IP')
        //             ]) {
        //                 echo 'Ejecutando pruebas unitarias'
        //                 sh '''
        //                    echo $SSH_PASSWORD | sshpass -p $SSH_PASSWORD ssh $SSH_USER@$SERVER_IP "cd /var/contenedor/unittest/unittest-suit && sudo -S git pull && sudo -S docker compose up"
        //                 '''
        //                 echo 'entro a carpeta y ejecuto pruebas unitarias'
        //             }
        //         }
        //     }
        // }
    }
}
