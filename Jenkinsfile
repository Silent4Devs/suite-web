pipeline {
    agent any

    environment {
        SSH_DEPLOY_USER = 'desarrollo'
        SSH_DEPLOY_HOST = '192.168.9.78'
        SSH_DEPLOY_PORT = 22
        GIT_REPO_URL = 'https://gitlab.com/silent4business/tabantaj.git'
        GIT_BRANCH_DEVELOP = 'develop'
        GIT_BRANCH_STAGING = 'stagging'
    }

    stages {
        stage('Checkout') {
            steps {
                script {
                    checkout([$class: 'GitSCM', branches: [[name: "${GIT_BRANCH_DEVELOP}"]], userRemoteConfigs: [[url: "${GIT_REPO_URL}"]]])
                }
            }
        }

        stage('Commit Changes in Develop') {
            steps {
                script {
                    sh """
                        cd /var/contenedor/tabantaj &&
                        git add public/vendor/sweetalert/sweetalert.all.js resources/views/vendor/sweetalert/alert.blade.php &&
                        git commit -m "Committing untracked changes in develop" &&
                        git push origin ${GIT_BRANCH_DEVELOP}
                    """
                }
            }
        }

        stage('Deploy to Staging') {
            steps {
                script {
                    sh """
                        ssh -o StrictHostKeyChecking=no -p ${SSH_DEPLOY_PORT} ${SSH_DEPLOY_USER}@${SSH_DEPLOY_HOST} '
                            cd /var/contenedor/tabantaj &&
                            git pull origin ${GIT_BRANCH_DEVELOP} &&
                            git checkout ${GIT_BRANCH_STAGING} &&
                            git merge ${GIT_BRANCH_DEVELOP}
                        '
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
