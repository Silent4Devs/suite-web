pipeline {
    agent any
    stages {
        stage('Declarative: Checkout SCM') {
            steps {
                checkout scm
            }
        }

        stage('Install') {
            steps {
                echo 'Installing dependencies...'
            }
        }

        stage('Build') {
            steps {
               echo 'Build dependencies...'
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
