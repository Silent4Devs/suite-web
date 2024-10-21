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
    
def test_clasificacion_create(browser):
    
 clasifiacion_create = Create_configurar_soporte(browser)
 clasifiacion_create.login()
 clasifiacion_create.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 clasifiacion_create.add_configurar_soporte(agregar_btn_xpath, guardar_xpath)
 

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[7]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/configurar-soporte'][text()='Configurar Soporte']"
agregar_btn_xpath = "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
guardar_xpath = "//BUTTON[@class='btn btn-primary'][normalize-space(text())='Guardar']"
