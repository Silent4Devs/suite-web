import pytest
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.gestion_contractual.index.gestion_contractual_page import GestionContractual
from selenium import webdriver
from config import username, password

@pytest.fixture(scope="session")
def browser():
    options = FirefoxOptions()
    options.add_argument('--headless')
    options.add_argument('--disable-gpu')
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')


    options.add_argument('--disable-extensions')
    options.add_argument('--disable-dev-shm-usage')
    options.add_argument('--disable-browser-side-navigation')
    options.add_argument('--disable-gpu')
    options.add_argument('--no-sandbox')
    options.add_argument('--log-level=3')

    #driver = webdriver.Chrome(options=options)
    driver = webdriver.Firefox(options=options)
    yield driver
    driver.quit()
#TEST
@pytest.mark.usefixtures("browser")
def test_gestion_contractual(browser):
    #LOGIN
    login_page = GestionContractual(browser)
    login_page.login()
    #MENÚ HAMBURGUESA
    menu = GestionContractual(browser)
    menu.open_menu()
    #GESTIÓN CONTRACTUAL
    gestion_contractual_module = GestionContractual(browser)
    gestion_contractual_module.go_to_gestion_contractual()
