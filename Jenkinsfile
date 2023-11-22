pipeline {
    agent any

    environment {
        // Configura las credenciales SSH en Jenkins y especifica el ID aquí
        SSH_CREDENTIALS = 'qHzfFsWSGn9fwswMH/7aaw7krOl/OcBwLw06SuxMK0c'
        SSH_HOST = '192.168.9.78'
        SSH_PORT = '22'  // Puerto SSH por defecto
        SOURCE_BRANCH = 'develop'
        TARGET_BRANCH = 'stagging'
    }

    stages {
        stage('Clonar y Desplegar') {
            steps {
                // Clonar el repositorio desde la rama source
                git branch: "${env.SOURCE_BRANCH}", url: 'https://gitlab.com/silent4business/tabantaj.git'

                // Configurar las credenciales SSH
                withCredentials([sshUserPrivateKey(credentialsId: env.SSH_CREDENTIALS, keyFileVariable: 'qHzfFsWSGn9fwswMH/7aaw7krOl/OcBwLw06SuxMK0c')]) {
                    // Desplegar en la rama target mediante SSH
                    sh """
                        ssh -i $KEYFILE -p ${env.SSH_PORT} desarrollo@${env.SSH_HOST} 'cd /var/contenedor/tabantaj && git checkout ${env.TARGET_BRANCH} && git pull origin ${env.SOURCE_BRANCH}'
                        # Realizar cualquier paso de despliegue adicional necesario
                    """
                }
            }
        }
    }

    post {
        success {
            // Acciones a realizar si el despliegue es exitoso
        }
        failure {
            // Acciones a realizar si el despliegue falla
        }
    }
}
