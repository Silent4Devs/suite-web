from pages.administracion.configurar_organizacion.sedes.create.sedes_create_page import Create_sedes
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
    
def test_create_sedes(browser):
    
 create_sedes = Create_sedes(browser)
 create_sedes.login()
 url_sedes_index = "https://192.168.9.78/admin/sedes"
 create_sedes.ruta_sedes_index(url_sedes_index)
 create_sedes.add_sedes(agregar_btn_xpath, sede, direccion, descripcion, organizacion, guardar_xpath)
 
#Variables
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
sede = "//INPUT[@id='sede']"
direccion = "//INPUT[@id='direccion']"
descripcion = "//TEXTAREA[@id='descripcion']"
organizacion = "//SELECT[@id='organizacion_id']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"


