from pages.administracion.ajustes_de_sistema.configurar_soporte.edit.configurar_soporte_edit_page import Edit_configurar_soporte
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
    
def test_configurar_soporte_edit(browser):
    
 configurar_soporte_edit = Edit_configurar_soporte(browser)
 configurar_soporte_edit.login()
 configurar_soporte_edit.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 configurar_soporte_edit.edit_configurarsoporte(btn_serch, btn_3Puntos, guardar_xpath)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[7]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/configurar-soporte'][text()='Configurar Soporte']"
agregar_btn_xpath = "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
guardar_xpath = "//button[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space(text()) = 'Guardar']"
btn_serch = "(//INPUT[@type='search'])[2]"
btn_3Puntos = "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"