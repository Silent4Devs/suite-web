pipeline {
    agent any

    environment {
        SSH_USER = 'desarrollo'
        SSH_PASSWORD = 'S3cur3.qa'
        SERVER_IP = '192.168.9.78'
        GIT_USERNAME = 'Saul183'
        GIT_PASSWORD = 'SaulGithub123'
    }

    stages {
        stage('Merge Branch') {
            steps {
                git branch: 'stagging', url: 'git@github.com:Silent4Devs/suite-web.git'
                sh 'git checkout stagging'
                sh 'git merge develop'
                sh 'git push origin stagging'
                sh '''
                    git config credential.username ${GIT_USERNAME}
                    git config credential.helper "!echo password=${GIT_PASSWORD}; echo"
                    git push https://${GIT_USERNAME}:${GIT_PASSWORD}@github.com/Silent4Devs/suite-web.git stagging
                '''
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
