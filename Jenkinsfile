pipeline {
    agent any

    stages {
        stage('Merge Branch') {
            steps {
                // Clonar el repositorio utilizando credenciales globales de Jenkins
                git credentialsId: 'jenkis123', url: 'git@github.com:Silent4Devs:Saul183/suite-web.git'

                // Checkout a la rama de staging
                sh 'git checkout staging'

                // Merge de la rama develop a la rama de staging
                sh 'git merge develop'

                // Push de los cambios a la rama de staging
                sh 'git push origin staging'
            }
        }
    }
}
