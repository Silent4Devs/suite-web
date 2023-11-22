pipeline {
  agent any

  stages {
    stage('Clonar repositorio') {
      steps {
        git branch: 'develop', credentialsId: 'desarrollo@192.168.9.78', url: 'https://gitlab.com/silent4business/tabantaj.git'
      }
    }

    stage('Compilar y empaquetar') {
      steps {
        // Agrega aquí los comandos necesarios para compilar y empaquetar tus archivos
      }
    }
    stage('Desplegar en QA') {
    environment {
        QA_SERVER = '192.168.9.78'
        QA_USER = 'desarrollo'
        QA_PORT = '22'
    }

    steps {
        sshagent(['desarrollo@192.168.9.78']) {
        sh "ssh -p ${QA_PORT} ${QA_USER}@${QA_SERVER} 'git pull origin stagging'"
    }
    }
  }
}
