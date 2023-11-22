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
                sh 'scp artefacto.tar.gz desarrollo@192.168.9.78:/var/contenedor/tabantaj' // O cualquier otro comando necesario para desplegar tu artefacto en un servidor remoto
            }
        }
    }
}
