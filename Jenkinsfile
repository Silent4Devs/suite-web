pipeline {
    agent any

    stages {
        stage('Clonar repositorio') {
            steps {
                script {
                    // Clonar el repositorio desde la rama develop
                    git branch: 'develop', credentialsId: 'desarrollo@192.168.9.78', url: 'https://gitlab.com/silent4business/tabantaj.git'
                }
            }
        }

        stage('Desplegar en QA') {
            environment {
                QA_SERVER = '192.168.9.78'
                QA_USER = 'desarrollo'
                QA_PORT = '22'
            }

            steps {
                script {
                    // Utilizar sshagent para autenticarse y ejecutar comandos en el servidor QA
                    sshagent(['desarrollo@192.168.9.78']) {
                        // Ejecutar git pull en la rama stagging en el servidor QA
                        sh "ssh -p ${QA_PORT} ${QA_USER}@${QA_SERVER} 'cd /var/contenedor/tabantaj && git pull origin stagging'"
                    }
                }
            }
        }
    }
}
