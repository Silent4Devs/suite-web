pipeline {
    agent any
    stages {
        stage('Clone Repository') {
            steps {
                withCredentials([string(credentialsId: 'github-token', variable: 'GITHUB_TOKEN')]) {
                    git branch: 'develop_Onpremise',
                        url: "https://${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}@github.com/Silent4Devs/suite-web.git"
                }
            }
        }
        stage('Deploy via SSH') {
            steps {
                script {
                    sh """
                    sshpass -p 'S3cur3.qa' scp -o StrictHostKeyChecking=no -r "$WORKSPACE/"* desarrollo@192.168.9.78:/var/contenedor/suite-web
                    """
                }
            }
        }
    }
}
