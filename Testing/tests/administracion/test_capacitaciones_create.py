from pages.administracion.configurar_c_humano.capacitaciones.create.capacitaciones_create_page import Create_Capacitaciones
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from selenium import webdriver
import pytest
"""
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
    
    driver = webdriver.Firefox(options=options)
    yield driver
    driver.quit() 
""" 
def test_create_capacitaciones(browser):
    
    capacitaciones_create = Create_Capacitaciones(browser)
    capacitaciones_create.login()
    url_apartado_index = "https://192.168.9.78/admin/recursos"
    capacitaciones_create.ruta_clausula_index(url_apartado_index)
    capacitaciones_create.add_capacitaciones(agregar_btn_xpath, titulo, categoria, tipo, modalidad, ubicacion, instructor, guardar_xpath)
 
#Variables
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/recursos/create'][text()='Registrar Capacitaciones']"
titulo = "//input[contains(@id,'cursoscapacitaciones')]"
categoria = "//SPAN[@id='select2-categoria_capacitacion_id-container']"
tipo = "//select[contains(@id,'tipo')]"
modalidad = "//SELECT[@id='select_modalidad']"
ubicacion = "//INPUT[@id='ubicacionConfInicial']"
instructor = "//INPUT[@id='instructor']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

