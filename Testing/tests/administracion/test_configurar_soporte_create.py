from pages.administracion.ajustes_de_sistema.configurar_soporte.create.configurar_soporte_create_page import Create_configurar_soporte
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
    
def test_configurar_soporte_create(browser):
    
 config_soporte_create = Create_configurar_soporte(browser)
 config_soporte_create.login()
 url_apartado_index = "https://192.168.9.78/admin/configurar-soporte"
 config_soporte_create.ruta_configurar_soporte_index(url_apartado_index)
 config_soporte_create.add_configurar_soporte(agregar_btn_xpath, rol, empleado,guardar_xpath)
 

#Variables

agregar_btn_xpath = "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
rol = "//SELECT[@id='rol']"
empleado = "//SELECT[@id='id_elaboro']"
guardar_xpath = "//BUTTON[@class='btn btn-danger'][normalize-space(text())='Guardar']"
