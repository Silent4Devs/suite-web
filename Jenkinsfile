pipeline {
    agent any

    stages {
        stage('Merge Branch') {
            steps {
                script {
                    // Clonar el repositorio utilizando SSH
                    git url: 'git@github.com:Silent4Devs/suite-web.git'

                    // Checkout a la rama de staging
                    checkout([$class: 'GitSCM', branches: [[name: 'stagging']], userRemoteConfigs: [[url: 'git@github.com:Silent4Devs/suite-web.git']]])

                    // Merge de la rama develop a la rama de staging
                    sh 'git merge develop'

                    // Push de los cambios a la rama de staging
                    sh 'git push origin stagging'
                }
            }
        }
    }
}
