from pages.administracion.ajustes_sg.clasificacion.create.clasifiacion_create_page import Create_Clasificacion
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
  
def test_clasificacion_create(browser):
    
 clasifiacion_create = Create_Clasificacion(browser)
 clasifiacion_create.login()
 url_apartado_index = "https://192.168.9.78/admin/auditorias/clasificacion-auditorias"
 clasifiacion_create.ruta_clasificacion_index(url_apartado_index)
 clasifiacion_create.add_clasificacion(agregar_btn_xpath, id, clasificacion, descripcion, guardar_xpath)

#Variables
agregar_btn_xpath= "//a[contains(.,'Nueva Clasificación')]"
id = "//input[contains(@id,'identificador')]"
clasificacion = "//input[contains(@id,'nombre')]"
descripcion = "//textarea[contains(@id,'descripcion')]"
guardar_xpath = "//button[@class='btn btn-danger' and normalize-space()='Guardar']"
