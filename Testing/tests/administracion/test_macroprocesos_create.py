from pages.administracion.configurar_organizacion.macroprocesos.create.macroprocesos_create_page import Macroprocesos_Create
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
    
def test_create_macroprocesos(browser):
    
 create_macroprocesos = Macroprocesos_Create(browser)
 create_macroprocesos.login()
 url_macroprocesos_index = "https://192.168.9.78/admin/macroprocesos"
 create_macroprocesos.ruta_macroprocesos_index(url_macroprocesos_index)
 create_macroprocesos.add_crear_macroprocesos(agregar_btn_xpath, codigo, nombre, grupo, descripcion, guardar_xpath)
 
#Variables
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
codigo = "//INPUT[@id='codigo']"
nombre = "//INPUT[@id='nombre']"
grupo = "//SELECT[@id='id_grupo']"
descripcion = "//TEXTAREA[@id='descripcion']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

