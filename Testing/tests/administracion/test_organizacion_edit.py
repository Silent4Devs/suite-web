from pages.administracion.configurar_organizacion.organizacion.edit.organizacion_edit_page import Edit_organizacion
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
    
def test_organizacion_edit(browser):
    
 organizacion_edit = Edit_organizacion(browser)
 organizacion_edit.login()
 organizacion_edit.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 organizacion_edit.edit_organizacion(editar_btn_xpath, guardar_xpath)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/organizacions'][text()='Organización']"
editar_btn_xpath= "//a[contains(@href,'/admin/organizacions/') and contains(@href,'/edit') and normalize-space()='Editar Organización']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"