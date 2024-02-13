pipeline {
    agent any

    environment {
        SSH_USER = 'desarrollo'
        SSH_PASSWORD = 'S3cur3.qa'
        SERVER_IP = '192.168.9.78'
    }


        stage('Merge Branch') {
            steps {
                // Clonar el repositorio utilizando credenciales globales de Jenkins
                git branch: 'stagging', url: 'https://github.com/Silent4Devs/suite-web.git'

                // Checkout a la rama de staging
                sh 'git checkout stagging'

                // Merge de la rama develop a la rama de staging
                sh 'git merge develop'

                // Push de los cambios a la rama de staging
                // sh 'git push origin stagging'
            }
        }


        stage('Git Pull via SSH') {
            steps {
                script {
                    sh '''
                       echo $SSH_PASSWORD | sshpass -p $SSH_PASSWORD ssh $SSH_USER@$SERVER_IP "cd /var/contenedores/tabantaj && sudo -S git pull"
                    '''
                }
            }
        }
}
