from pages.administracion.configurar_vistas.mi_organizacion.edit.mi_organizacion_edit_page import Check_Mi_Organizacion
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

def test_edit_mi_organizacion(browser) :
    
    edit_mi_organizacion = Check_Mi_Organizacion(browser)
    edit_mi_organizacion.login()
    edit_mi_organizacion.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    edit_mi_organizacion.edit_mi_organizacion()
    
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[5]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/panel-organizacion'][text()='Mi Organización']"




