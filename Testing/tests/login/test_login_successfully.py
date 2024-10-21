import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.login.login_successfully import LoginPage
from config import username, password

@pytest.fixture(scope="session")
def browser():
    options = FirefoxOptions()  # Para Chrome en modo headless
    # options = FirefoxOptions()  # Para Firefox en modo headless
    options.add_argument('--headless')
    options.add_argument('--disable-gpu')  # para Chrome en modo headless
    options.add_argument('--no-sandbox')  # necesario para ejecución en Docker
    options.add_argument('--disable-dev-shm-usage')  # para evitar problemas con /dev/shm

    # Limitar la cantidad de memoria utilizada por el navegador
    options.add_argument('--disable-extensions')
    options.add_argument('--disable-dev-shm-usage')
    options.add_argument('--disable-browser-side-navigation')
    options.add_argument('--disable-gpu')
    options.add_argument('--no-sandbox')
    options.add_argument('--log-level=3')

    #driver = webdriver.Chrome(options=options)  # para Chrome en modo headless
    driver = webdriver.Firefox(options=options)  # para Firefox en modo headless
    yield driver
    driver.quit()

def test_login(browser):
    #INITIALIZE PAGE OBJECT
    login_successfully =LoginPage(browser)
    #LOGIN
    login_successfully.login()


