
import pytest
from selenium import webdriver
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from pages.administracion.configurar_organizacion.procesos.create.procesos_create_page import Create_Procesos


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
    
def test_create_procesos(browser):
    
 create_procesos = Create_Procesos(browser)
 create_procesos.login()
 url_procesos_index = "https://192.168.9.78/admin/procesos"
 create_procesos.ruta_procesos_index(url_procesos_index)
 create_procesos.add_procesos(agregar_btn_xpath, codigo, nombre, macroprocesos, descripcion, guardar_xpath)
 
#Variables
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/procesos/create'][text()='Registrar Proceso']"
codigo = "//INPUT[@id='codigo']"
nombre = "//INPUT[@id='nombre']"
macroprocesos = "//SELECT[@id='id_macroproceso']"
descripcion = "//TEXTAREA[@id='descripcion']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

