
pipeline {
    agent any

    parameters {
        string(name: 'SSH_KEY', description: 'Nombre de la clave SSH en Jenkins', defaultValue: '/root/.ssh/id_rsa')
        string(name: 'USER', description: 'Usuario del servidor SSH', defaultValue: 'desarrollo')
        string(name: 'SERVER', description: 'Dirección del servidor SSH', defaultValue: '192.168.9.78')
        string(name: 'DEPLOY_PATH', description: 'Ruta de despliegue en el servidor', defaultValue: '/var/contenedor/tabantaj')
    }

    stages {
         stage('install') {
            steps {
                git branch: 'stagging', url: 'https://gitlab.com/silent4business/tabantaj.git'
            }
          }

        stage('Build') {
            steps {
                // Puedes agregar comandos de construcción aquí
                // Por ejemplo: sh 'npm install' o 'mvn clean install'
            }
        }

        stage('Deploy') {
            steps {
                script {
                    sshagent(['${params.SSH_KEY}']) {
                        def remoteCommand = """
                            cd ${params.DEPLOY_PATH} &&
                            git pull origin stagging &&
                            docker-compose up -d --build
                        """
                        sh "ssh ${params.USER}@${params.SERVER} '${remoteCommand}'"
                    }
                }
            }
        }
    }

    post {
        success {
            // Notificar éxito del despliegue, por ejemplo, enviar correo electrónico
            echo 'El despliegue fue exitoso'
        }
        failure {
            // Notificar fallo del despliegue, por ejemplo, enviar correo electrónico
            echo 'El despliegue falló'
        }
    }
}
