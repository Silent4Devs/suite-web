from pages.administracion.ajustes_sg.clausula.create.clausula_create_page import Create_clausula
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from selenium import webdriver
import pytest

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
    
def test_clausula_create(browser):
    
 clausula_create = Create_clausula(browser)
 clausula_create.login()
 url_apartado_index = "https://192.168.9.78/admin/auditorias/clausulas-auditorias"
 clausula_create.ruta_clausula_index(url_apartado_index)
 clausula_create.add_clausula(agregar_btn_xpath, id, clausula, descripcion,guardar_xpath)

#Variables
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/auditorias/clausulas-auditorias/create'][text()='Nueva Cláusula']"
id = "//INPUT[@id='identificador']"
clausula = "//INPUT[@id='nombre']"
descripcion = "//TEXTAREA[@id='descripcion']"
guardar_xpath = "//button[@class='btn btn-danger' and normalize-space()='Guardar']"
