pipeline {
    agent any
    stages {
        stage('Install') {
            steps {
                git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
            }
        }

        stage('Build') {
            steps {
               echo 'Build dependencies... jenkis 1'
            }
        }

        stage('Jenkis2') {
            steps {
                script {
                    // Asegúrate de que 'Jenkinsfilev1' también tenga su propio bloque de pipeline
                    load 'Jenkinsfilev1'
                }
            }
        }
    }
}
