import pytest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options as ChromeOptions
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.requisiciones.create.requisiciones_create_page import Requisiciones_create

@pytest.fixture(scope="session")
def browser():
    #options = ChromeOptions()
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

def test_requisiciones_create(browser):
    #LOGIN
    requisiciones_create_page= Requisiciones_create(browser)
    requisiciones_create_page.login()
    #MENÚ HAMBURGUESA
    requisiciones_create_page.open_menu()
    #GESTION CONTRACTUAL
    requisiciones_create_page.go_to_gestion_contractual()
    #REQUISICIONES
    requisiciones_create_page.requisiciones_module()
    #REQUSICIONES CREATE
    requisiciones_create_page.requisiciones_create()
    #FECHA INICIO
    fecha_solicitud = "2022-05-01"
    requisiciones_create_page.fecha_solicitud(fecha_solicitud)
    #RAZÓN SOCIAL
    requisiciones_create_page.razon_social()
    #TITULO REQUISICIÓN
    titulo_requisicion = "TEST"
    requisiciones_create_page.titulo_requisicion(titulo_requisicion)
    #COMPRADOR
    requisiciones_create_page.comprador()
    #PROYECTO
    proyecto = "/ KONFIO_PENTEST_001_21 - Servicios de Pruebas de Penetración"
    requisiciones_create_page.proyecto(proyecto)
