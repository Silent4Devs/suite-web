from pages.administracion.configurar_c_humano.capacitaciones.edit.capacitaciones_edit_page import Edit_Capacitaciones
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
 
def test_edit_capacitaciones(browser):
    
    capacitaciones_edit = Edit_Capacitaciones(browser)
    capacitaciones_edit.login()
    capacitaciones_edit.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    capacitaciones_edit.edit_capacitaciones(campo_buscar_xpath, trespuntos_btn_xpath, btn2_editar, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[4]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/recursos'][text()='Capacitaciones']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
trespuntos_btn_xpath= "(//BUTTON[@class='btn btn-action-show-datatables-global d-none'])[1]"
btn2_editar = "(//I[@class='fas fa-edit'])[1]"

