from pages.administracion.configurar_organizacion.organizacion.panel_cotrol.organizacion_panel_control_page import Edit_panel_de_control_organizacion
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
    
def test_organizacion_panel_de_control(browser):
    
 clasifiacion_panel_de_control = Edit_panel_de_control_organizacion(browser)
 clasifiacion_panel_de_control.login()
 clasifiacion_panel_de_control.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 clasifiacion_panel_de_control.edit_panel_de_control(panel_de_control)
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/organizacions'][text()='Organización']"
panel_de_control = "//a[contains(@class, 'btn') and contains(@class, 'btn-success') and normalize-space()='Panel de Control']"