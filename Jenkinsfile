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

        stage('Desplegar en Staging') {
            environment {
                QA_SERVER = '192.168.9.78'
                QA_USER = 'desarrollo'
                QA_PORT = '22'
            }

            steps {
                script {
                    // Actualizar la rama develop local antes de realizar cualquier acción en el servidor
                    git checkout develop
                    git pull origin develop
                }

                script {
                    // Utilizar sshagent para autenticarse y ejecutar comandos en el servidor QA
                    sshagent(['desarrollo@192.168.9.78']) {
                        // Revisar los cambios en la rama stagging en el servidor antes de fusionar
                        sh "git fetch origin stagging"
                        sh "git diff develop..origin/stagging"
                    }
                }

                script {
                    // Fusionar los cambios de develop en la rama stagging en el servidor
                    sshagent(['desarrollo@192.168.9.78']) {
                        sh "ssh -p ${QA_PORT} ${QA_USER}@${QA_SERVER} 'cd /var/contenedor/tabantaj && git pull origin develop:stagging'"
                    }
                }
            }
        }
    }
}
