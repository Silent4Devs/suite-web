import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.capacitaciones.capacitaciones_page import CapacitacionesPage
from config import username, password

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

def test_capacitaciones(browser):

    capacitaciones_page = CapacitacionesPage(browser)
    capacitaciones_page.login()

    capacitaciones_page.open_menu()

    capacitaciones_page.go_to_capacitaciones()
    capacitaciones_page.mis_cursos()

    capacitaciones_page.primer_filtro()
    capacitaciones_page.segundo_filtro()
    capacitaciones_page.tercer_filtro()


