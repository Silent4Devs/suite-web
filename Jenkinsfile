pipeline {
    agent any

    stages {
        stage('Merge Branch') {
            steps {
                // Clonar el repositorio utilizando SSH
                git url: 'git@github.com:Silent4Devs:Saul183/suite-web.git'

                // Checkout a la rama de staging
                script {
                    sh 'git checkout stagging'
                }

                // Merge de la rama develop a la rama de staging
                script {
                    sh 'git merge develop'
                }

                // Push de los cambios a la rama de staging
                script {
                    sh 'git push origin stagging'
                }
            }
        }
    }
}
