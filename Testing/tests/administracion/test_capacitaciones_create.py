from pages.administracion.configurar_c_humano.capacitaciones.create.capacitaciones_create_page import Create_Capacitaciones
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
 
def test_create_capacitaciones(browser):
    
    capacitaciones_create = Create_Capacitaciones(browser)
    capacitaciones_create.login()
    capacitaciones_create.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    capacitaciones_create.add_capacitaciones(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[4]"
#element_entrar_modulo = "(//I[@class='material-symbols-outlined i-direct'][text()='keyboard_arrow_down'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/recursos'][text()='Capacitaciones']"
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/recursos/create'][text()='Registrar Capacitaciones']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

