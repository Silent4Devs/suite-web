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
                git branch: 'develop', url: 'https://gitlab.com/silent4business/tabantaj.git'
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
                    load 'Jenkinsfilev1'
                }
            }
        }
    }
}
