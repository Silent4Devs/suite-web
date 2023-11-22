pipeline {
    agent any

    stages {
        stage('Clonar repositorio') {
            steps {
                git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
            }
        }
        stage('Desplegar') {
            steps {
                sh 'scp Jenkinsfile desarrollo@192.168.9.78:/var/contenedor/tabantaj'
            }
        }
    }
}
