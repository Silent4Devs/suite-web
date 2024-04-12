from pages.administracion.configurar_organizacion.glosario.edit.glosario_edit_page import Edit_Gloario
from selenium.webdriver.firefox.options import Options as FirefoxOptions
from selenium import webdriver
import pytest
"""
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
    driver.quit() """
    
def test_edit_glosario(browser):
    
    edit_glosario = Edit_Gloario(browser)
    edit_glosario.login()
    edit_glosario.in_submodulo(menu_hamburguesa,element_entrar_submodulo)
    edit_glosario.edit_glosario(campo_buscar_xpath, boton_editar, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/glosarios'][text()='Glosario']"

campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
boton_editar = "(//I[@class='fas fa-edit'])[1]"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"