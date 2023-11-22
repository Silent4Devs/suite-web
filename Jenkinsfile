pipeline {
    agent any

    environment {
        SSH_KEY = credentials('frqkaGqX977wGgEBKYFA')
    }

    stages {
        stage('Checkout') {
            steps {
                script {
                    checkout scm
                }
            }
        }

        stage('Build') {
            steps {
                // Agrega aquí los pasos de construcción de tu aplicación
            }
        }

        stage('Deploy via SSH') {
            steps {
                script {
                    // Configura las credenciales SSH
                    withCredentials([sshUserPrivateKey(credentialsId: 'frqkaGqX977wGgEBKYFA', keyFileVariable: 'frqkaGqX977wGgEBKYFA')]) {
                        // Aquí puedes usar la variable de entorno SSH_KEY
                        sh 'ssh -i $SSH_KEY desarrollo@192.168.9.78 "cd /var/contenedor/tabantaj && git push origin develop:stagging"'
                    }
                }
            }
        }
    }
}
