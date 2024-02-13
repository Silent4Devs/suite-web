pipeline {
    agent any

    environment {
        SSH_USER = 'desarrollo'
        SSH_PASSWORD = 'S3cur3.qa'
        SERVER_IP = '192.168.9.78'
    }

    stages {
        stage('Merge Branch') {
            steps {
                git branch: 'stagging', url: 'https://github.com/Silent4Devs/suite-web.git'
                sh 'git checkout stagging'
                sh 'git merge develop'
            }
        }

        stage('Git Pull via SSH') {
            steps {
                script {
                   sh '''
                       echo $SSH_PASSWORD | sshpass -p $SSH_PASSWORD ssh $SSH_USER@$SERVER_IP "cd /var/contenedor/suite-web && sudo -S git pull"
                    '''
                }
            }
        }
    }
}
