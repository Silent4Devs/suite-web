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

        stage('Stash de cambios locales en develop') {
            steps {
                script {
                    // Stash de los cambios locales en develop
                    git stash save "Stash de cambios locales"
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
                    // Utilizar sshagent para autenticarse y ejecutar comandos en el servidor QA
                    sshagent(['desarrollo@192.168.9.78']) {
                        // Ejecutar git pull en la rama staging en el servidor QA
                        sh "ssh -p ${QA_PORT} ${QA_USER}@${QA_SERVER} 'cd /var/contenedor/tabantaj && git pull origin develop:stagging'"
                    }
                }
            }
        }

        stage('Aplicar stash de cambios locales en develop') {
            steps {
                script {
                    // Aplicar los cambios locales guardados previamente
                    git stash pop
                }
            }
        }
    }
}
