pipeline {
    agent any

    stages {
        stage('Merge Branch') {
            steps {
                // Clonar el repositorio utilizando credenciales globales de Jenkins
                git branch: 'stagging', url: 'https://github.com/Silent4Devs/suite-web.git'

                // Checkout a la rama de staging
                sh 'git checkout stagging'

                // Merge de la rama develop a la rama de staging
                sh 'git merge develop'

                // Push de los cambios a la rama de staging
                sh 'git push origin stagging'
            }
        }
    }
}
