import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.centro_atencion.riesgos.centro_atencion_riesgos import  RiesgosView

@pytest.fixture(scope="session")
def browser():
    options = FirefoxOptions()
    # options = ChromeOptions()
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

def test_centro_atencion_riesgos(browser):
    #INITIALIZE PAGE OBJECT
    centro_atencion_riesgos = RiesgosView(browser)
    #LOGIN
    centro_atencion_riesgos.login()
    #OPEN MENU
    centro_atencion_riesgos.open_menu()
    #NAVIGATE TO CENTRO DE ATENCION
    centro_atencion_riesgos.navigate_to_centro_atencion()
