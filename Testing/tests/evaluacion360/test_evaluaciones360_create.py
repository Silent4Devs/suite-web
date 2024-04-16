import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.evaluacion360.create.evaluaciones360_create_page import Evaluaciones360Create
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


def test_evaluaciones360_create(browser):

    evaluaciones360_create = Evaluaciones360Create(browser)
    evaluaciones360_create.login()
    index_cap_humano = "https://192.168.9.78/admin/capital-humano"
    evaluaciones360_create.cap_humano_index(index_cap_humano)
    evaluaciones360_create.ev360_options()
    evaluaciones360_create.crear_ev360()
    nombre = "Evaluación 360"
    evaluaciones360_create.nombre_evaluacion(nombre)
    descripcion = "Evaluación 360 para empleados"
    evaluaciones360_create.descripcion_evaluacion(descripcion)
    evaluaciones360_create.check_evaluacion()
    evaluaciones360_create.siguiente()
    evaluaciones360_create.publico_objetivo_select()
    evaluaciones360_create.siguiente_2()
    xpath=("//button[contains(@class, 'btn-success') and contains(@class, 'btn-md') and contains(@class, 'btn') and contains(@class, 'mr-2') and contains(@class, 'fas') and contains(@class, 'fa-arrow-circle-right') and contains(@class, 'Siguiente')]")
    evaluaciones360_create.siguiente_3(xpath)
