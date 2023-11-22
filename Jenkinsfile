pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                checkout([$class: "GitSCM",
                    branches: [[name: 'stagging']],
                    doGenerateSubmoduleConfigurations: false,
                    extensions: [
                        [$class: "LocalBranch", localBranch: '**'],
                        [$class: "WipeWorkspace"],
                        [$class: "CleanBeforeCheckout"]
                    ],
                    submoduleCfg: [],
                    userRemoteConfigs: [[credentialsId: 'desarrollo@192.168.9.78', url: 'https://gitlab.com/silent4business/tabantaj.git']]
                ])
            }
        }

        stage('Build') {
            steps {
                // Realizar las tareas de construcción (por ejemplo, compilación del código, instalación de dependencias, etc.)
            }
        }

        stage('Deploy') {
            steps {
                sh 'docker build -t tabantaj .'
                sh 'docker run -d -p 8080:80 tabantaj:latest'
            }
        }
    }
}
