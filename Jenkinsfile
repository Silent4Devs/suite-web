pipeline {
    agent any

    environment {
        SSH_DEPLOY_USER = 'desarrollo'
        SSH_DEPLOY_HOST = '192.168.9.78'
        SSH_DEPLOY_PORT = 22
        GIT_REPO_URL = 'https://gitlab.com/silent4business/tabantaj.git'
        GIT_BRANCH_DEVELOP = 'develop'
        GIT_BRANCH_STAGING = 'stagging' // Corregí el nombre de la rama aquí
    }

    stages {
        stage('Checkout') {
            steps {
                script {
                    dir('/var/contenedor/tabantaj') {
                        checkout([$class: 'GitSCM', branches: [[name: "${GIT_BRANCH_DEVELOP}"]], userRemoteConfigs: [[url: "${GIT_REPO_URL}"]]])
                    }
                }
            }
        }

        stage('Deploy to Staging') {
            steps {
                script {
                    sh """
                        cd /var/contenedor/tabantaj &&
                        git pull origin ${GIT_BRANCH_DEVELOP} &&
                        git checkout ${GIT_BRANCH_STAGING} &&
                        git merge origin/${GIT_BRANCH_DEVELOP}
                    """
                }
            }
        }
    }

    post {
        success {
            echo 'Deployment to staging successful!'
        }
    }
}
