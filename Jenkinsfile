pipeline {
    agent any

    stages {
        stage('Clonar repositorio') {
            steps {
                git branch: 'stagging', url: 'https://gitlab.com/silent4business/tabantaj.git'
            }
        }
        stage('Desplegar') {
            steps {
                sshagent(['/root/.ssh/id_rsa']) {
                sh 'scp Jenkinsfile desarrollo@192.168.9.78:/var/contenedor/tabantaj'
                }
            }
        }
    }
}
